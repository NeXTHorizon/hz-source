package nhz;

import nhz.peer.Peer;
import nhz.util.Observable;
import org.json.simple.JSONObject;

public interface BlockchainProcessor extends Observable<Block,BlockchainProcessor.Event> {

    public static enum Event {
        BLOCK_PUSHED, BLOCK_POPPED, BLOCK_GENERATED, BLOCK_SCANNED,
        RESCAN_BEGIN, RESCAN_END,
        BEFORE_BLOCK_ACCEPT,
        BEFORE_BLOCK_APPLY, AFTER_BLOCK_APPLY,
        BEFORE_BLOCK_UNDO
    }

    Peer getLastBlockchainFeeder();

    int getLastBlockchainFeederHeight();

    boolean isScanning();

    void processPeerBlock(JSONObject request) throws NhzException;

    void fullReset();


    public static class BlockNotAcceptedException extends NhzException {

        BlockNotAcceptedException(String message) {
            super(message);
        }

    }

    public static class TransactionNotAcceptedException extends BlockNotAcceptedException {

        private final TransactionImpl transaction;

        TransactionNotAcceptedException(String message, TransactionImpl transaction) {
            super(message  + " transaction: " + transaction.getJSONObject().toJSONString());
            this.transaction = transaction;
        }

        public Transaction getTransaction() {
            return transaction;
        }

    }

    public static class BlockOutOfOrderException extends BlockNotAcceptedException {

        BlockOutOfOrderException(String message) {
            super(message);
        }

	}

}
