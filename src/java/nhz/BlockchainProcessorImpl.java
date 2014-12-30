package nhz;

import nhz.crypto.Crypto;
import nhz.peer.Peer;
import nhz.peer.Peers;
import nhz.util.Convert;
import nhz.util.DbIterator;
import nhz.util.JSON;
import nhz.util.Listener;
import nhz.util.Listeners;
import nhz.util.Logger;
import nhz.util.ThreadPool;
import org.json.simple.JSONArray;
import org.json.simple.JSONObject;
import org.json.simple.JSONStreamAware;
import org.json.simple.JSONValue;

import java.math.BigInteger;
import java.security.MessageDigest;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Collections;
import java.util.HashMap;
import java.util.HashSet;
import java.util.List;
import java.util.Map;
import java.util.Set;
import java.util.SortedMap;
import java.util.TreeMap;
import java.util.TreeSet;

final class BlockchainProcessorImpl implements BlockchainProcessor {

    private static final byte[] CHECKSUM_TRANSPARENT_FORGING = new byte[]{-75, -47, 54, -19, 77, 48, 32, 97, 126, -111, -41, 90, 18, 116, 2, 45, -2, 68, -33, 38, 108, -105, -10, 69, -51, 112, 81, 110, 33, 59, 34, 23};
	private static final byte[] CHECKSUM_BLOCK_1000 = new byte[]{ -119, -41, 39, -28, -91, -89, -63, -64, -105, -7, -120, -108, -104, 31, 23, 31,117, 29, -57, -71, 22, -31, 86, 77, -5, -94, 11, 61, 14, 91, 63, -24};
    private static final byte[] CHECKSUM_NQT_BLOCK = new byte[]{106, -81, -37, -67, 107, 97, 86, -66, -76, -111, 3, -79, -50, -57, 81, 122, -50, -86, 34, 58, 72, -67, 33, -26, 94, -98, -12, -1, 81, 91, -63, -64};

    private static final BlockchainProcessorImpl instance = new BlockchainProcessorImpl();

    static BlockchainProcessorImpl getInstance() {
        return instance;
    }

    private final BlockchainImpl blockchain = BlockchainImpl.getInstance();
    private final TransactionProcessorImpl transactionProcessor = TransactionProcessorImpl.getInstance();

    private final Listeners<Block, Event> blockListeners = new Listeners<>();
    private volatile Peer lastBlockchainFeeder;
    private volatile int lastBlockchainFeederHeight;

    private volatile boolean isScanning;

    private final Runnable getMoreBlocksThread = new Runnable() {

        private final JSONStreamAware getCumulativeDifficultyRequest;

        {
            JSONObject request = new JSONObject();
            request.put("requestType", "getCumulativeDifficulty");
            getCumulativeDifficultyRequest = JSON.prepareRequest(request);
        }

        private boolean peerHasMore;

        @Override
        public void run() {

            try {
                try {
                    peerHasMore = true;
                    Peer peer = Peers.getAnyPeer(Peer.State.CONNECTED, true);
                    if (peer == null) {
                        return;
                    }
                    lastBlockchainFeeder = peer;
                    JSONObject response = peer.send(getCumulativeDifficultyRequest);
                    if (response == null) {
                        return;
                    }
                    BigInteger curCumulativeDifficulty = blockchain.getLastBlock().getCumulativeDifficulty();
                    String peerCumulativeDifficulty = (String) response.get("cumulativeDifficulty");
                    if (peerCumulativeDifficulty == null) {
                        return;
                    }
                    BigInteger betterCumulativeDifficulty = new BigInteger(peerCumulativeDifficulty);
                    if (betterCumulativeDifficulty.compareTo(curCumulativeDifficulty) <= 0) {
                        return;
                    }
                    if (response.get("blockchainHeight") != null) {
                        lastBlockchainFeederHeight = ((Long) response.get("blockchainHeight")).intValue();
                    }

                    Long commonBlockId = Genesis.GENESIS_BLOCK_ID;

                    if (! blockchain.getLastBlock().getId().equals(Genesis.GENESIS_BLOCK_ID)) {
                        commonBlockId = getCommonMilestoneBlockId(peer);
                    }
                    if (commonBlockId == null || !peerHasMore) {
                        return;
                    }

                    commonBlockId = getCommonBlockId(peer, commonBlockId);
                    if (commonBlockId == null || !peerHasMore) {
                        return;
                    }

                    final Block commonBlock = BlockDb.findBlock(commonBlockId);
                    if (blockchain.getLastBlock().getHeight() - commonBlock.getHeight() >= 720) {
                        return;
                    }

                    Long currentBlockId = commonBlockId;
                    List<BlockImpl> forkBlocks = new ArrayList<>();

                    boolean processedAll = true;
                    int requestCount = 0;
                    outer:
                    while (forkBlocks.size() < 1440 && requestCount++ < 10) {
                        JSONArray nextBlocks = getNextBlocks(peer, currentBlockId);
                        if (nextBlocks == null || nextBlocks.size() == 0) {
                            break;
                        }

                        synchronized (blockchain) {

                            for (Object o : nextBlocks) {
                                JSONObject blockData = (JSONObject) o;
                                BlockImpl block;
                                try {
                                    block = parseBlock(blockData);
                                } catch (NhzException.NotCurrentlyValidException e) {
                                    Logger.logDebugMessage("Cannot validate block: " + e.toString()
                                            + ", will try again later", e);
                                    processedAll = false;
                                    break outer;
                                } catch (RuntimeException|NhzException.ValidationException e) {
                                    Logger.logDebugMessage("Failed to parse block: " + e.toString(), e);
                                    peer.blacklist(e);
                                    return;
                                }
                                currentBlockId = block.getId();

                                if (blockchain.getLastBlock().getId().equals(block.getPreviousBlockId())) {
                                    try {
                                        pushBlock(block);
                                    } catch (BlockNotAcceptedException e) {
                                        peer.blacklist(e);
                                        return;
                                    }
                                } else if (! BlockDb.hasBlock(block.getId())) {
                                    forkBlocks.add(block);
                                }

                            }

                        } //synchronized

                    }

                    if (forkBlocks.size() > 0) {
                        processedAll = false;
                    }

                    if (! processedAll && blockchain.getLastBlock().getHeight() - commonBlock.getHeight() < 720) {
                        processFork(peer, forkBlocks, commonBlock);
                    }

                } catch (Exception e) {
                    Logger.logDebugMessage("Error in milestone blocks processing thread", e);
                }
            } catch (Throwable t) {
                Logger.logMessage("CRITICAL ERROR. PLEASE REPORT TO THE DEVELOPERS.\n" + t.toString());
                t.printStackTrace();
                System.exit(1);
            }

        }

        private Long getCommonMilestoneBlockId(Peer peer) {

            String lastMilestoneBlockId = null;

            while (true) {
                JSONObject milestoneBlockIdsRequest = new JSONObject();
                milestoneBlockIdsRequest.put("requestType", "getMilestoneBlockIds");
                if (lastMilestoneBlockId == null) {
                    milestoneBlockIdsRequest.put("lastBlockId", blockchain.getLastBlock().getStringId());
                } else {
                    milestoneBlockIdsRequest.put("lastMilestoneBlockId", lastMilestoneBlockId);
                }

                JSONObject response = peer.send(JSON.prepareRequest(milestoneBlockIdsRequest));
                if (response == null) {
                    return null;
                }
                JSONArray milestoneBlockIds = (JSONArray) response.get("milestoneBlockIds");
                if (milestoneBlockIds == null) {
                    return null;
                }
                if (milestoneBlockIds.isEmpty()) {
                    return Genesis.GENESIS_BLOCK_ID;
                }
                // prevent overloading with blockIds
                if (milestoneBlockIds.size() > 20) {
                    Logger.logDebugMessage("Obsolete or rogue peer " + peer.getPeerAddress() + " sends too many milestoneBlockIds, blacklisting");
                    peer.blacklist();
                    return null;
                }
                if (Boolean.TRUE.equals(response.get("last"))) {
                    peerHasMore = false;
                }
                for (Object milestoneBlockId : milestoneBlockIds) {
                    Long blockId = Convert.parseUnsignedLong((String) milestoneBlockId);
                    if (BlockDb.hasBlock(blockId)) {
                        if (lastMilestoneBlockId == null && milestoneBlockIds.size() > 1) {
                            peerHasMore = false;
                        }
                        return blockId;
                    }
                    lastMilestoneBlockId = (String) milestoneBlockId;
                }
            }

        }

        private Long getCommonBlockId(Peer peer, Long commonBlockId) {

            while (true) {
                JSONObject request = new JSONObject();
                request.put("requestType", "getNextBlockIds");
                request.put("blockId", Convert.toUnsignedLong(commonBlockId));
                JSONObject response = peer.send(JSON.prepareRequest(request));
                if (response == null) {
                    return null;
                }
                JSONArray nextBlockIds = (JSONArray) response.get("nextBlockIds");
                if (nextBlockIds == null || nextBlockIds.size() == 0) {
                    return null;
                }
                // prevent overloading with blockIds
                if (nextBlockIds.size() > 1440) {
                    Logger.logDebugMessage("Obsolete or rogue peer " + peer.getPeerAddress() + " sends too many nextBlockIds, blacklisting");
                    peer.blacklist();
                    return null;
                }

                for (Object nextBlockId : nextBlockIds) {
                    Long blockId = Convert.parseUnsignedLong((String) nextBlockId);
                    if (! BlockDb.hasBlock(blockId)) {
                        return commonBlockId;
                    }
                    commonBlockId = blockId;
                }
            }

        }

        private JSONArray getNextBlocks(Peer peer, Long curBlockId) {

            JSONObject request = new JSONObject();
            request.put("requestType", "getNextBlocks");
            request.put("blockId", Convert.toUnsignedLong(curBlockId));
            JSONObject response = peer.send(JSON.prepareRequest(request));
            if (response == null) {
                return null;
            }

            JSONArray nextBlocks = (JSONArray) response.get("nextBlocks");
            if (nextBlocks == null) {
                return null;
            }
            // prevent overloading with blocks
            if (nextBlocks.size() > 1440) {
                Logger.logDebugMessage("Obsolete or rogue peer " + peer.getPeerAddress() + " sends too many nextBlocks, blacklisting");
                peer.blacklist();
                return null;
            }

            return nextBlocks;

        }

        private void processFork(Peer peer, final List<BlockImpl> forkBlocks, final Block commonBlock) {

            synchronized (blockchain) {
                BigInteger curCumulativeDifficulty = blockchain.getLastBlock().getCumulativeDifficulty();

                popOffTo(commonBlock);

                int pushedForkBlocks = 0;
                if (blockchain.getLastBlock().getId().equals(commonBlock.getId())) {
                    for (BlockImpl block : forkBlocks) {
                        if (blockchain.getLastBlock().getId().equals(block.getPreviousBlockId())) {
                            try {
                                pushBlock(block);
                                pushedForkBlocks += 1;
                            } catch (BlockNotAcceptedException e) {
                                peer.blacklist(e);
                                break;
                            }
                        }
                    }
                }

                if (pushedForkBlocks > 0 && blockchain.getLastBlock().getCumulativeDifficulty().compareTo(curCumulativeDifficulty) < 0) {
                    Logger.logDebugMessage("Pop off caused by peer " + peer.getPeerAddress() + ", blacklisting");
                    peer.blacklist();
                    popOffTo(commonBlock);
                }
            } // synchronized

        }

        private void popOffTo(Block commonBlock) {
            try {
                Long lastBlockId = blockchain.getLastBlock().getId();
                while (! lastBlockId.equals(commonBlock.getId()) && ! lastBlockId.equals(Genesis.GENESIS_BLOCK_ID)) {
                    lastBlockId = popLastBlock();
                }
            } catch (TransactionType.UndoNotSupportedException e) {
                Logger.logDebugMessage(e.getMessage());
                Logger.logDebugMessage("Popping off last block not possible, will do a rescan");
                resetTo(commonBlock);
            }
        }

        private void resetTo(Block commonBlock) {
            if (commonBlock.getNextBlockId() != null) {
                Logger.logDebugMessage("Last block is " + blockchain.getLastBlock().getStringId() + " at " + blockchain.getLastBlock().getHeight());
                Logger.logDebugMessage("Deleting blocks after height " + commonBlock.getHeight());
                BlockDb.deleteBlocksFrom(commonBlock.getNextBlockId());
            }
            Logger.logMessage("Will do a re-scan");
            blockListeners.notify(commonBlock, BlockchainProcessor.Event.RESCAN_BEGIN);
            scan();
            blockListeners.notify(commonBlock, BlockchainProcessor.Event.RESCAN_END);
            Logger.logDebugMessage("Last block is " + blockchain.getLastBlock().getStringId() + " at " + blockchain.getLastBlock().getHeight());
        }

    };

    private BlockchainProcessorImpl() {

        blockListeners.addListener(new Listener<Block>() {
            @Override
            public void notify(Block block) {
                if (block.getHeight() % 5000 == 0) {
                    Logger.logMessage("processed block " + block.getHeight());
                }
            }
        }, Event.BLOCK_SCANNED);

        ThreadPool.runBeforeStart(new Runnable() {
            @Override
            public void run() {
                addGenesisBlock();
                scan();
            }
        }, false);

        ThreadPool.scheduleThread(getMoreBlocksThread, 1);

    }

    @Override
    public boolean addListener(Listener<Block> listener, BlockchainProcessor.Event eventType) {
        return blockListeners.addListener(listener, eventType);
    }

    @Override
    public boolean removeListener(Listener<Block> listener, Event eventType) {
        return blockListeners.removeListener(listener, eventType);
    }

    @Override
    public Peer getLastBlockchainFeeder() {
        return lastBlockchainFeeder;
    }

    @Override
    public int getLastBlockchainFeederHeight() {
        return lastBlockchainFeederHeight;
    }

    @Override
    public boolean isScanning() {
        return isScanning;
    }

    @Override
    public void processPeerBlock(JSONObject request) throws NhzException {
        BlockImpl block = parseBlock(request);
        pushBlock(block);
    }

    @Override
    public void fullReset() {
        synchronized (blockchain) {
            //BlockDb.deleteBlock(Genesis.GENESIS_BLOCK_ID); // fails with stack overflow in H2
            BlockDb.deleteAll();
            addGenesisBlock();
            scan();
        }
    }

    private void addBlock(BlockImpl block) {
        try (Connection con = Db.getConnection()) {
            try {
                BlockDb.saveBlock(con, block);
                blockchain.setLastBlock(block);
                con.commit();
            } catch (SQLException e) {
                con.rollback();
                throw e;
            }
        } catch (SQLException e) {
            throw new RuntimeException(e.toString(), e);
        }
    }

    private void addGenesisBlock() {
        if (BlockDb.hasBlock(Genesis.GENESIS_BLOCK_ID)) {
            Logger.logMessage("Genesis block already in database");
            return;
        }
        Logger.logMessage("Genesis block not in database, starting from scratch");
        try {
            SortedMap<Long,TransactionImpl> transactionsMap = new TreeMap<>();

            for (int i = 0; i < Genesis.GENESIS_RECIPIENTS.length; i++) {
                TransactionImpl transaction = new TransactionImpl.BuilderImpl((byte) 0, Genesis.CREATOR_PUBLIC_KEY,
                        Genesis.GENESIS_AMOUNTS[i] * Constants.ONE_NHZ, 0, 0, (short) 0,
                        Attachment.ORDINARY_PAYMENT)
                        .recipientId(Genesis.GENESIS_RECIPIENTS[i])
                        .signature(Genesis.GENESIS_SIGNATURES[i])
                        .build();
                transactionsMap.put(transaction.getId(), transaction);
            }

            MessageDigest digest = Crypto.sha256();
            for (Transaction transaction : transactionsMap.values()) {
                digest.update(transaction.getBytes());
            }

            BlockImpl genesisBlock = new BlockImpl(-1, 0, null, Constants.MAX_BALANCE_NQT, 0, transactionsMap.size() * 128, digest.digest(),
                    Genesis.CREATOR_PUBLIC_KEY, new byte[64], Genesis.GENESIS_BLOCK_SIGNATURE, null, new ArrayList<>(transactionsMap.values()));

            genesisBlock.setPrevious(null);

            addBlock(genesisBlock);

        } catch (NhzException.ValidationException e) {
            Logger.logMessage(e.getMessage());
            throw new RuntimeException(e.toString(), e);
        }
    }

    private byte[] calculateTransactionsChecksum() {
        MessageDigest digest = Crypto.sha256();
        try (Connection con = Db.getConnection();
             PreparedStatement pstmt = con.prepareStatement(
                     "SELECT * FROM transaction ORDER BY id ASC, timestamp ASC");
             DbIterator<TransactionImpl> iterator = blockchain.getTransactions(con, pstmt)) {
            while (iterator.hasNext()) {
                digest.update(iterator.next().getBytes());
            }
        } catch (SQLException e) {
            throw new RuntimeException(e.toString(), e);
        }
        return digest.digest();
    }

    private void pushBlock(final BlockImpl block) throws BlockNotAcceptedException {

        int curTime = Convert.getEpochTime();

        synchronized (blockchain) {
            try {

                BlockImpl previousLastBlock = blockchain.getLastBlock();

                if (! previousLastBlock.getId().equals(block.getPreviousBlockId())) {
                    throw new BlockOutOfOrderException("Previous block id doesn't match");
                }

                if (block.getVersion() != getBlockVersion(previousLastBlock.getHeight())) {
                    throw new BlockNotAcceptedException("Invalid version " + block.getVersion());
                }

                if (! Constants.isTestnet) {
	                if (previousLastBlock.getHeight() == Constants.TRANSPARENT_FORGING_BLOCK) {
	                    byte[] checksum = calculateTransactionsChecksum();
	                    if (CHECKSUM_TRANSPARENT_FORGING == null) {
	                        Logger.logMessage("Checksum calculated:\n" + Arrays.toString(checksum));
	                    } else if (!Arrays.equals(checksum, CHECKSUM_TRANSPARENT_FORGING)) {
	                        Logger.logMessage("Checksum failed at block " + Constants.TRANSPARENT_FORGING_BLOCK);
	                        throw new BlockNotAcceptedException("Checksum failed");
	                    } else {
	                        Logger.logMessage("Checksum passed at block " + Constants.TRANSPARENT_FORGING_BLOCK);
	                    }
	                }
	
					if (previousLastBlock.getHeight() == Constants.BLOCK_1000) {
	                    byte[] checksum = calculateTransactionsChecksum();	
	                    if (CHECKSUM_BLOCK_1000 == null) {
	                        Logger.logMessage("Checksum calculated:\n" + Arrays.toString(checksum));
	                    } else if (!Arrays.equals(checksum, CHECKSUM_BLOCK_1000)) {
	                        Logger.logMessage("Checksum failed at block " + Constants.BLOCK_1000);
	                        throw new BlockNotAcceptedException("Checksum failed");
	                    } else {
	                        Logger.logMessage("Checksum passed at block " + Constants.BLOCK_1000);
	                    }
	                }
                
	                if (previousLastBlock.getHeight() == Constants.NQT_BLOCK) {
	                    byte[] checksum = calculateTransactionsChecksum();
	                    if (CHECKSUM_NQT_BLOCK == null) {
	                        Logger.logMessage("Checksum calculated:\n" + Arrays.toString(checksum));
	                    } else if (!Arrays.equals(checksum, CHECKSUM_NQT_BLOCK)) {
	                        Logger.logMessage("Checksum failed at block " + Constants.NQT_BLOCK);
	                        throw new BlockNotAcceptedException("Checksum failed");
	                    } else {
	                        Logger.logMessage("Checksum passed at block " + Constants.NQT_BLOCK);
	                    }
	                }
                }
                
                if (block.getVersion() != 1 && ! Arrays.equals(Crypto.sha256().digest(previousLastBlock.getBytes()), block.getPreviousBlockHash())) {
                    throw new BlockNotAcceptedException("Previous block hash doesn't match");
                }
                if (block.getTimestamp() > curTime + 15 || block.getTimestamp() <= previousLastBlock.getTimestamp()) {
                    throw new BlockOutOfOrderException("Invalid timestamp: " + block.getTimestamp()
                            + " current time is " + curTime + ", previous block timestamp is " + previousLastBlock.getTimestamp());
                }
                if (block.getId().equals(Long.valueOf(0L)) || BlockDb.hasBlock(block.getId())) {
                    throw new BlockNotAcceptedException("Duplicate block or invalid id");
                }
                if (! block.verifyGenerationSignature()) {
                    throw new BlockNotAcceptedException("Generation signature verification failed");
                }
                if (! block.verifyBlockSignature()) {
                    throw new BlockNotAcceptedException("Block signature verification failed");
                }

                Map<TransactionType, Set<String>> duplicates = new HashMap<>();
                long calculatedTotalAmount = 0;
                long calculatedTotalFee = 0;
                MessageDigest digest = Crypto.sha256();

                Set<Long> unappliedUnconfirmed = transactionProcessor.undoAllUnconfirmed();
                Set<Long> appliedUnconfirmed = new HashSet<>();

                try {

                    for (TransactionImpl transaction : block.getTransactions()) {
                    	 Logger.logDebugMessage("Transaction Id"+transaction.getStringId()+"\ntx json: "+  transaction.getJSONObject().toJSONString()  +"\ntx bytes: "+ Convert.toHexString(transaction.getBytes()));
                        // cfb: Block 303 contains a transaction which expired before the block timestamp
                        if (transaction.getTimestamp() > curTime + 15 || transaction.getTimestamp() > block.getTimestamp() + 15
                                || (transaction.getExpiration() < block.getTimestamp() && previousLastBlock.getHeight() != 303)) {
                            throw new TransactionNotAcceptedException("Invalid transaction timestamp " + transaction.getTimestamp()
                                    + " for transaction " + transaction.getStringId() + ", current time is " + curTime
                                    + ", block timestamp is " + block.getTimestamp(), transaction);
                        }
                        if (TransactionDb.hasTransaction(transaction.getId())) {
                            throw new TransactionNotAcceptedException("Transaction " + transaction.getStringId()
                                    + " is already in the blockchain", transaction);
                        }
                        if (transaction.getReferencedTransactionFullHash() != null) {
                            if ((previousLastBlock.getHeight() < Constants.REFERENCED_TRANSACTION_FULL_HASH_BLOCK
                                    && !TransactionDb.hasTransaction(Convert.fullHashToId(transaction.getReferencedTransactionFullHash())))
                                    || (previousLastBlock.getHeight() >= Constants.REFERENCED_TRANSACTION_FULL_HASH_BLOCK
                                    && !hasAllReferencedTransactions(transaction, transaction.getTimestamp(), 0))) {
                                throw new TransactionNotAcceptedException("Missing or invalid referenced transaction "
                                        + transaction.getReferencedTransactionFullHash()
                                        + " for transaction " + transaction.getStringId(), transaction);
                            }
                        }
                        if (transaction.getVersion() != transactionProcessor.getTransactionVersion(previousLastBlock.getHeight())) {
                            throw new TransactionNotAcceptedException("Invalid transaction version " + transaction.getVersion()
                                    + " at height " + previousLastBlock.getHeight(), transaction);
                        }
                        if (!transaction.verifySignature()) {
                            throw new TransactionNotAcceptedException("Signature verification failed for transaction "
                                    + transaction.getStringId() + " at height " + previousLastBlock.getHeight(), transaction);
                        }
                        if (!EconomicClustering.verifyFork(transaction)) {
                            Logger.logDebugMessage("Block " + block.getStringId() + " height " + (previousLastBlock.getHeight() + 1)
                                    + " contains transaction that was generated on a fork: "
                                    + transaction.getStringId() + " ecBlockHeight " + transaction.getECBlockHeight() + " ecBlockId "
                                    + Convert.toUnsignedLong(transaction.getECBlockId()));
                            //throw new TransactionNotAcceptedException("Transaction belongs to a different fork", transaction);
                        }
                        if (transaction.getId().equals(Long.valueOf(0L))) {
                            throw new TransactionNotAcceptedException("Invalid transaction id", transaction);
                        }
                        if (transaction.isDuplicate(duplicates)) {
                            throw new TransactionNotAcceptedException("Transaction is a duplicate: "
                                    + transaction.getStringId(), transaction);
                        }
                        try {
                            transaction.validate();
                        } catch (NhzException.ValidationException e) {
                            throw new TransactionNotAcceptedException(e.getMessage(), transaction);
                        }

                        if (transaction.applyUnconfirmed()) {
                            appliedUnconfirmed.add(transaction.getId());
                        } else {
                            throw new TransactionNotAcceptedException("Double spending transaction: " + transaction.getStringId(), transaction);
                        }

                        calculatedTotalAmount += transaction.getAmountNQT();

                        calculatedTotalFee += transaction.getFeeNQT();

                        digest.update(transaction.getBytes());

                    }

                    if (calculatedTotalAmount != block.getTotalAmountNQT() || calculatedTotalFee != block.getTotalFeeNQT()) {
                        throw new BlockNotAcceptedException("Total amount or fee don't match transaction totals");
                    }
                    if (!Arrays.equals(digest.digest(), block.getPayloadHash())) {
                        throw new BlockNotAcceptedException("Payload hash doesn't match");
                    }

                    block.setPrevious(previousLastBlock);
                    blockListeners.notify(block, Event.BEFORE_BLOCK_ACCEPT);
                    addBlock(block);

                    unappliedUnconfirmed.removeAll(appliedUnconfirmed);

                } catch (TransactionNotAcceptedException | RuntimeException e) {
                    for (TransactionImpl transaction : block.getTransactions()) {
                        if (appliedUnconfirmed.contains(transaction.getId())) {
                            transaction.undoUnconfirmed();
                        }
                    }
                    throw e;
                } finally {
                    transactionProcessor.applyUnconfirmed(unappliedUnconfirmed);
                }

                blockListeners.notify(block, Event.BEFORE_BLOCK_APPLY);
                transactionProcessor.apply(block);
                blockListeners.notify(block, Event.AFTER_BLOCK_APPLY);
                blockListeners.notify(block, Event.BLOCK_PUSHED);
                transactionProcessor.updateUnconfirmedTransactions(block);

            } catch (RuntimeException e) {
                Logger.logMessage("Error pushing block", e);
                BlockDb.deleteBlocksFrom(block.getId());
                scan();
                throw new BlockNotAcceptedException(e.toString());
            }

        } // synchronized

        if (block.getTimestamp() >= Convert.getEpochTime() - 15) {
            Peers.sendToSomePeers(block);
        }

    }

    private Long popLastBlock() throws TransactionType.UndoNotSupportedException {
        try {
            synchronized (blockchain) {
                BlockImpl block = blockchain.getLastBlock();
                Logger.logDebugMessage("Will pop block " + block.getStringId() + " at height " + block.getHeight());
                if (block.getId().equals(Genesis.GENESIS_BLOCK_ID)) {
                    throw new RuntimeException("Cannot pop off genesis block");
                }
                BlockImpl previousBlock = BlockDb.findBlock(block.getPreviousBlockId());
                blockListeners.notify(block, Event.BEFORE_BLOCK_UNDO);
                blockchain.setLastBlock(block, previousBlock);
                transactionProcessor.undo(block);
                BlockDb.deleteBlocksFrom(block.getId());
                blockListeners.notify(block, Event.BLOCK_POPPED);
                return previousBlock.getId();
            } // synchronized

        } catch (RuntimeException e) {
            Logger.logDebugMessage("Error popping last block: " + e.toString(), e);
            throw new TransactionType.UndoNotSupportedException(e.toString());
        }
    }

    int getBlockVersion(int previousBlockHeight) {
        return previousBlockHeight < Constants.TRANSPARENT_FORGING_BLOCK ? 1
                : previousBlockHeight < Constants.NQT_BLOCK ? 2
                : 3;
    }

    boolean generateBlock(String secretPhrase, int blockTimestamp) {

        Set<TransactionImpl> sortedTransactions = new TreeSet<>();

        for (TransactionImpl transaction : transactionProcessor.getAllUnconfirmedTransactions()) {
            if (hasAllReferencedTransactions(transaction, transaction.getTimestamp(), 0)) {
                sortedTransactions.add(transaction);
            }
        }

        BlockImpl previousBlock = blockchain.getLastBlock();
        if (previousBlock.getHeight() < Constants.ASSET_EXCHANGE_BLOCK) {
            return true;
        }

        SortedMap<Long, TransactionImpl> newTransactions = new TreeMap<>();
        Map<TransactionType, Set<String>> duplicates = new HashMap<>();

        long totalAmountNQT = 0;
        long totalFeeNQT = 0;
        int payloadLength = 0;

        while (payloadLength <= Constants.MAX_PAYLOAD_LENGTH && newTransactions.size() <= Constants.MAX_NUMBER_OF_TRANSACTIONS) {

            int prevNumberOfNewTransactions = newTransactions.size();

            for (TransactionImpl transaction : sortedTransactions) {

                int transactionLength = transaction.getSize();
                if (newTransactions.get(transaction.getId()) != null || payloadLength + transactionLength > Constants.MAX_PAYLOAD_LENGTH) {
                    continue;
                }

                if (transaction.getVersion() != transactionProcessor.getTransactionVersion(previousBlock.getHeight())) {
                    continue;
                }

                if (transaction.getTimestamp() > blockTimestamp + 15 || (transaction.getExpiration() < blockTimestamp)) {
                    continue;
                }

                if (transaction.isDuplicate(duplicates)) {
                    continue;
                }

                try {
                    transaction.validate();
                } catch (NhzException.NotCurrentlyValidException e) {
                    continue;
                } catch (NhzException.ValidationException e) {
                    transactionProcessor.removeUnconfirmedTransactions(Collections.singletonList(transaction));
                    continue;
                }

                if (!EconomicClustering.verifyFork(transaction)) {
                    Logger.logDebugMessage("Including transaction that was generated on a fork: " + transaction.getStringId()
                            + " ecBlockHeight " + transaction.getECBlockHeight() + " ecBlockId " + Convert.toUnsignedLong(transaction.getECBlockId()));
                    //continue;
                }

                newTransactions.put(transaction.getId(), transaction);
                payloadLength += transactionLength;
                totalAmountNQT += transaction.getAmountNQT();
                totalFeeNQT += transaction.getFeeNQT();

            }

            if (newTransactions.size() == prevNumberOfNewTransactions) {
                break;
            }
        }

        final byte[] publicKey = Crypto.getPublicKey(secretPhrase);

        MessageDigest digest = Crypto.sha256();
        for (Transaction transaction : newTransactions.values()) {
            digest.update(transaction.getBytes());
        }

        byte[] payloadHash = digest.digest();

        digest.update(previousBlock.getGenerationSignature());
        byte[] generationSignature = digest.digest(publicKey);

        BlockImpl block;
        byte[] previousBlockHash = Crypto.sha256().digest(previousBlock.getBytes());

        try {

            block = new BlockImpl(getBlockVersion(previousBlock.getHeight()), blockTimestamp, previousBlock.getId(), totalAmountNQT, totalFeeNQT, payloadLength,
                    payloadHash, publicKey, generationSignature, null, previousBlockHash, new ArrayList<>(newTransactions.values()));

        } catch (NhzException.ValidationException e) {
            // shouldn't happen because all transactions are already validated
            Logger.logMessage("Error generating block", e);
            return true;
        }

        block.sign(secretPhrase);

        if (isScanning) {
            return true;
        }

        block.setPrevious(previousBlock);

        try {
            pushBlock(block);
            blockListeners.notify(block, Event.BLOCK_GENERATED);
            Logger.logDebugMessage("Account " + Convert.toUnsignedLong(block.getGeneratorId()) + " generated block " + block.getStringId()
                    + " at height " + block.getHeight());
            return true;
        } catch (TransactionNotAcceptedException e) {
            Logger.logDebugMessage("Generate block failed: " + e.getMessage());
            Transaction transaction = e.getTransaction();
            Logger.logDebugMessage("Removing invalid transaction: " + transaction.getStringId());
            transactionProcessor.removeUnconfirmedTransactions(Collections.singletonList((TransactionImpl)transaction));
            return false;
        } catch (BlockNotAcceptedException e) {
            Logger.logDebugMessage("Generate block failed: " + e.getMessage());
        }
        return true;
    }

    private BlockImpl parseBlock(JSONObject blockData) throws NhzException.ValidationException {
        return BlockImpl.parseBlock(blockData);
    }

    private boolean hasAllReferencedTransactions(Transaction transaction, int timestamp, int count) {
        if (transaction.getReferencedTransactionFullHash() == null) {
            return timestamp - transaction.getTimestamp() < 60 * 1440 * 60 && count < 10;
        }
        transaction = TransactionDb.findTransactionByFullHash(transaction.getReferencedTransactionFullHash());
        return transaction != null && hasAllReferencedTransactions(transaction, timestamp, count + 1);
    }

    private volatile boolean validateAtScan = Nhz.getBooleanProperty("nhz.forceValidate");

    void validateAtNextScan() {
        validateAtScan = true;
    }

    private void scan() {
        synchronized (blockchain) {
            isScanning = true;
            Logger.logMessage("Scanning blockchain...");
            if (validateAtScan) {
                Logger.logDebugMessage("Also verifying signatures and validating transactions...");
            }
            Account.clear();
            Alias.clear();
            Asset.clear();
            Order.clear();
            Poll.clear();
            Trade.clear();
            Vote.clear();
            DigitalGoodsStore.clear();
            Set<TransactionImpl> lostTransactions = new HashSet<>(transactionProcessor.getAllUnconfirmedTransactions());
            transactionProcessor.clear();
            Generator.clear();
            blockchain.setLastBlock(BlockDb.findBlock(Genesis.GENESIS_BLOCK_ID));
            Account.addOrGetAccount(Genesis.CREATOR_ID).apply(Genesis.CREATOR_PUBLIC_KEY, 0);
            try (Connection con = Db.getConnection();
                 PreparedStatement pstmt = con.prepareStatement("SELECT * FROM block ORDER BY db_id ASC");
                 ResultSet rs = pstmt.executeQuery()) {
                Long currentBlockId = Genesis.GENESIS_BLOCK_ID;
                BlockImpl currentBlock = null;
                while (rs.next()) {
                    try {
                        currentBlock = BlockDb.loadBlock(con, rs);
                        if (! currentBlock.getId().equals(currentBlockId)) {
                            throw new NhzException.NotValidException("Database blocks in the wrong order!");
                        }
                        if (validateAtScan && ! currentBlockId.equals(Genesis.GENESIS_BLOCK_ID)) {
                            if (!currentBlock.verifyBlockSignature() || !currentBlock.verifyGenerationSignature()) {
                                throw new NhzException.NotValidException("Invalid block signature");
                            }
                            if (currentBlock.getVersion() != getBlockVersion(blockchain.getHeight())) {
                                throw new NhzException.NotValidException("Invalid block version");
                            }
                            byte[] blockBytes = currentBlock.getBytes();
                            JSONObject blockJSON = (JSONObject) JSONValue.parse(currentBlock.getJSONObject().toJSONString());
                            if (! Arrays.equals(blockBytes, parseBlock(blockJSON).getBytes())) {
                                throw new NhzException.NotValidException("Block JSON cannot be parsed back to the same block");
                            }
                            for (TransactionImpl transaction : currentBlock.getTransactions()) {
                                if (!transaction.verifySignature()) {
                                    throw new NhzException.NotValidException("Invalid transaction signature");
                                }
                                if (transaction.getVersion() != transactionProcessor.getTransactionVersion(blockchain.getHeight())) {
                                    throw new NhzException.NotValidException("Invalid transaction version");
                                }
                                if (! EconomicClustering.verifyFork(transaction)) {
                                    Logger.logDebugMessage("Found transaction that was generated on a fork: " + transaction.getStringId()
                                            + " in block " + currentBlock.getStringId() + " at height " + currentBlock.getHeight()
                                            + " ecBlockHeight " + transaction.getECBlockHeight() + " ecBlockId " + Convert.toUnsignedLong(transaction.getECBlockId()));
                                    //throw new NhzException.NotValidException("Invalid transaction fork");
                                }
                                transaction.validate();
                                byte[] transactionBytes = transaction.getBytes();
                                if (currentBlock.getHeight() > Constants.NQT_BLOCK
                                        && ! Arrays.equals(transactionBytes, transactionProcessor.parseTransaction(transactionBytes).getBytes())) {
                                    throw new NhzException.NotValidException("Transaction bytes cannot be parsed back to the same transaction");
                                }
                                JSONObject transactionJSON = (JSONObject) JSONValue.parse(transaction.getJSONObject().toJSONString());
                                if (! Arrays.equals(transactionBytes, transactionProcessor.parseTransaction(transactionJSON).getBytes())) {
                                    throw new NhzException.NotValidException("Transaction JSON cannot be parsed back to the same transaction");
                                }
                            }
                        }
                        for (TransactionImpl transaction : currentBlock.getTransactions()) {
                            if (! transaction.applyUnconfirmed()) {
                                throw new TransactionNotAcceptedException("Double spending transaction: "
                                        + transaction.getStringId(), transaction);
                            }
                        }
                        blockListeners.notify(currentBlock, Event.BEFORE_BLOCK_ACCEPT);
                        blockchain.setLastBlock(currentBlock);
                        blockListeners.notify(currentBlock, Event.BEFORE_BLOCK_APPLY);
                        currentBlock.apply();
                        for (TransactionImpl transaction : currentBlock.getTransactions()) {
                            transaction.apply();
                        }
                        blockListeners.notify(currentBlock, Event.AFTER_BLOCK_APPLY);
                        blockListeners.notify(currentBlock, Event.BLOCK_SCANNED);
                        currentBlockId = currentBlock.getNextBlockId();
                    } catch (NhzException|RuntimeException e) {
                        Logger.logDebugMessage(e.toString(), e);
                        Logger.logDebugMessage("Applying block " + Convert.toUnsignedLong(currentBlockId) + " at height "
                                + (currentBlock == null ? 0 : currentBlock.getHeight()) + " failed, deleting from database");
                        if (currentBlock != null) {
                            lostTransactions.addAll(currentBlock.getTransactions());
                        }
                        while (rs.next()) {
                            try {
                                currentBlock = BlockDb.loadBlock(con, rs);
                                lostTransactions.addAll(currentBlock.getTransactions());
                            } catch (NhzException.ValidationException ignore) {}
                        }
                        BlockDb.deleteBlocksFrom(currentBlockId);
                        scan();
                    }
                }
            } catch (SQLException e) {
                throw new RuntimeException(e.toString(), e);
            }
            transactionProcessor.processTransactions(lostTransactions, true);
            validateAtScan = false;
            Logger.logMessage("...done");
            isScanning = false;
        } // synchronized
    }

}
