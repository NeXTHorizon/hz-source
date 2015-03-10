package nhz.http;

import nhz.Account;
import nhz.Alias;
import nhz.Asset;
import nhz.Generator;
import nhz.Nhz;
import nhz.Order;
import nhz.Poll;
import nhz.Trade;
import nhz.Vote;
import nhz.peer.Peer;
import nhz.peer.Peers;
import nhz.util.Convert;
import org.json.simple.JSONObject;
import org.json.simple.JSONStreamAware;

import javax.servlet.http.HttpServletRequest;
import java.util.List;

public final class GetState extends APIServlet.APIRequestHandler {

    static final GetState instance = new GetState();

    private GetState() {
        super(new APITag[] {APITag.INFO});
    }

    @Override
    JSONStreamAware processRequest(HttpServletRequest req) {

        JSONObject response = new JSONObject();

        response.put("application", Nhz.APPLICATION);
        response.put("version", Nhz.VERSION);
        response.put("time", Convert.getEpochTime());
        response.put("lastBlock", Nhz.getBlockchain().getLastBlock().getStringId());
        response.put("cumulativeDifficulty", Nhz.getBlockchain().getLastBlock().getCumulativeDifficulty().toString());

        long totalEffectiveBalance = 0;
        for (Account account : Account.getAllAccounts()) {
            long effectiveBalanceNHZ = account.getEffectiveBalanceNHZ();
            if (effectiveBalanceNHZ > 0) {
                totalEffectiveBalance += effectiveBalanceNHZ;
            }
        }
        response.put("totalEffectiveBalanceNHZ", totalEffectiveBalance);

        response.put("numberOfBlocks", Nhz.getBlockchain().getHeight() + 1);
        response.put("numberOfTransactions", Nhz.getBlockchain().getTransactionCount());
        response.put("numberOfAccounts", Account.getAllAccounts().size());
        response.put("numberOfAssets", Asset.getAllAssets().size());
        response.put("numberOfOrders", Order.Ask.getAllAskOrders().size() + Order.Bid.getAllBidOrders().size());
        int numberOfTrades = 0;
        for (List<Trade> assetTrades : Trade.getAllTrades()) {
            numberOfTrades += assetTrades.size();
        }
        response.put("numberOfTrades", numberOfTrades);
        response.put("numberOfAliases", Alias.getAllAliases().size());
        response.put("numberOfPolls", Poll.getAllPolls().size());
        response.put("numberOfVotes", Vote.getVotes().size());
        response.put("numberOfPeers", Peers.getAllPeers().size());
        response.put("numberOfUnlockedAccounts", Generator.getAllGenerators().size());
        Peer lastBlockchainFeeder = Nhz.getBlockchainProcessor().getLastBlockchainFeeder();
        response.put("lastBlockchainFeeder", lastBlockchainFeeder == null ? null : lastBlockchainFeeder.getAnnouncedAddress());
        response.put("lastBlockchainFeederHeight", Nhz.getBlockchainProcessor().getLastBlockchainFeederHeight());
        response.put("isScanning", Nhz.getBlockchainProcessor().isScanning());
        response.put("availableProcessors", Runtime.getRuntime().availableProcessors());
        response.put("maxMemory", Runtime.getRuntime().maxMemory());
        response.put("totalMemory", Runtime.getRuntime().totalMemory());
        response.put("freeMemory", Runtime.getRuntime().freeMemory());

        return response;
    }

}
