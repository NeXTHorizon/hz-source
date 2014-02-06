package nxt.http;

import nxt.Block;
import nxt.Blockchain;
import nxt.Transaction;
import nxt.util.Convert;
import org.json.simple.JSONObject;
import org.json.simple.JSONStreamAware;

import javax.servlet.http.HttpServletRequest;

import static nxt.http.JSONResponses.INCORRECT_TRANSACTION;
import static nxt.http.JSONResponses.MISSING_TRANSACTION;
import static nxt.http.JSONResponses.UNKNOWN_TRANSACTION;

final class GetTransaction extends HttpRequestHandler {

    static final GetTransaction instance = new GetTransaction();

    private GetTransaction() {}

    @Override
    public JSONStreamAware processRequest(HttpServletRequest req) {

        String transaction = req.getParameter("transaction");
        if (transaction == null) {
            return MISSING_TRANSACTION;
        }

        Long transactionId;
        Transaction transactionData;
        try {

            transactionId = Convert.parseUnsignedLong(transaction);
            transactionData = Blockchain.getTransaction(transactionId);
        } catch (RuntimeException e) {
            return INCORRECT_TRANSACTION;
        }

        JSONObject response;
        if (transactionData == null) {
            transactionData = Blockchain.getUnconfirmedTransaction(transactionId);
            if (transactionData == null) {
                return UNKNOWN_TRANSACTION;
            } else {
                response = transactionData.getJSONObject();
                response.put("sender", Convert.convert(transactionData.getSenderAccountId()));
            }
        } else {
            response = transactionData.getJSONObject();
            response.put("sender", Convert.convert(transactionData.getSenderAccountId()));
            Block block = transactionData.getBlock();
            response.put("block", block.getStringId());
            response.put("confirmations", Blockchain.getLastBlock().getHeight() - block.getHeight() + 1);
        }

        return response;
    }

}