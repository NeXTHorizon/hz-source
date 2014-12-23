package nhz.http;

import nhz.Nhz;
import nhz.NhzException;
import nhz.Transaction;
import nhz.util.Convert;
import nhz.util.Logger;
import org.json.simple.JSONObject;
import org.json.simple.JSONStreamAware;
import org.json.simple.JSONValue;

import javax.servlet.http.HttpServletRequest;

import static nhz.http.JSONResponses.INCORRECT_TRANSACTION_BYTES;
import static nhz.http.JSONResponses.MISSING_TRANSACTION_BYTES_OR_JSON;

public final class ParseTransaction extends APIServlet.APIRequestHandler {

    static final ParseTransaction instance = new ParseTransaction();

    private ParseTransaction() {
        super(new APITag[] {APITag.TRANSACTIONS}, "transactionBytes", "transactionJSON");
    }

    @Override
    JSONStreamAware processRequest(HttpServletRequest req) throws NhzException.ValidationException {

        String transactionBytes = Convert.emptyToNull(req.getParameter("transactionBytes"));
        String transactionJSON = Convert.emptyToNull(req.getParameter("transactionJSON"));
        if (transactionBytes == null && transactionJSON == null) {
            return MISSING_TRANSACTION_BYTES_OR_JSON;
        }
        JSONObject response;
        try {
            Transaction transaction;
            if (transactionBytes != null) {
                byte[] bytes = Convert.parseHexString(transactionBytes);
                transaction = Nhz.getTransactionProcessor().parseTransaction(bytes);
            } else {
                JSONObject json = (JSONObject) JSONValue.parse(transactionJSON);
                transaction = Nhz.getTransactionProcessor().parseTransaction(json);
            }
            transaction.validate();
            response = JSONData.unconfirmedTransaction(transaction);
            response.put("verify", transaction.verifySignature());
        } catch (NhzException.ValidationException|RuntimeException e) {
            Logger.logDebugMessage(e.getMessage(), e);
            return INCORRECT_TRANSACTION_BYTES;
        }
        return response;
    }

}
