package nhz.http;

import nhz.Account;
import nhz.Block;
import nhz.Nhz;
import nhz.NhzException;
import nhz.util.DbIterator;
import org.json.simple.JSONArray;
import org.json.simple.JSONObject;
import org.json.simple.JSONStreamAware;

import javax.servlet.http.HttpServletRequest;

public final class GetAccountBlockIds extends APIServlet.APIRequestHandler {

    static final GetAccountBlockIds instance = new GetAccountBlockIds();

    private GetAccountBlockIds() {
        super(new APITag[] {APITag.ACCOUNTS}, "account", "timestamp");
    }

    @Override
    JSONStreamAware processRequest(HttpServletRequest req) throws NhzException {

        Account account = ParameterParser.getAccount(req);
        int timestamp = ParameterParser.getTimestamp(req);

        JSONArray blockIds = new JSONArray();
        try (DbIterator<? extends Block> iterator = Nhz.getBlockchain().getBlocks(account, timestamp)) {
            while (iterator.hasNext()) {
                Block block = iterator.next();
                blockIds.add(block.getStringId());
            }
        }

        JSONObject response = new JSONObject();
        response.put("blockIds", blockIds);

        return response;
    }

}
