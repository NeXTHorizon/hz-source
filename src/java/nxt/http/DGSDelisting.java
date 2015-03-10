package nhz.http;

import nhz.Account;
import nhz.Attachment;
import nhz.DigitalGoodsStore;
import nhz.NhzException;
import org.json.simple.JSONStreamAware;

import javax.servlet.http.HttpServletRequest;

import static nhz.http.JSONResponses.UNKNOWN_GOODS;

public final class DGSDelisting extends CreateTransaction {

    static final DGSDelisting instance = new DGSDelisting();

    private DGSDelisting() {
        super(new APITag[] {APITag.DGS, APITag.CREATE_TRANSACTION}, "goods");
    }

    @Override
    JSONStreamAware processRequest(HttpServletRequest req) throws NhzException {
        Account account = ParameterParser.getSenderAccount(req);
        DigitalGoodsStore.Goods goods = ParameterParser.getGoods(req);
        if (goods.isDelisted() || !goods.getSellerId().equals(account.getId())) {
            return UNKNOWN_GOODS;
        }
        Attachment attachment = new Attachment.DigitalGoodsDelisting(goods.getId());
        return createTransaction(req, account, attachment);
    }

}
