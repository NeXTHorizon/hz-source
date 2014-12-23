package nhz.http;

import nhz.NhzException;
import org.json.simple.JSONStreamAware;

final class ParameterException extends NhzException {

    private final JSONStreamAware errorResponse;

    ParameterException(JSONStreamAware errorResponse) {
        this.errorResponse = errorResponse;
    }

    JSONStreamAware getErrorResponse() {
        return errorResponse;
    }

}
