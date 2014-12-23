package nhz;

public abstract class NhzException extends Exception {

    protected NhzException() {
        super();
    }

    protected NhzException(String message) {
        super(message);
    }

    protected NhzException(String message, Throwable cause) {
        super(message, cause);
    }

    protected NhzException(Throwable cause) {
        super(cause);
    }

    public static abstract class ValidationException extends NhzException {

        private ValidationException(String message) {
            super(message);
        }

        private ValidationException(String message, Throwable cause) {
            super(message, cause);
        }

    }

    public static class NotCurrentlyValidException extends ValidationException {

        public NotCurrentlyValidException(String message) {
            super(message);
        }

        public NotCurrentlyValidException(String message, Throwable cause) {
            super(message, cause);
        }

    }

    public static final class NotYetEnabledException extends NotCurrentlyValidException {

        public NotYetEnabledException(String message) {
            super(message);
        }

        public NotYetEnabledException(String message, Throwable throwable) {
            super(message, throwable);
        }

    }

    public static final class NotValidException extends ValidationException {

        public NotValidException(String message) {
            super(message);
        }

        public NotValidException(String message, Throwable cause) {
            super(message, cause);
        }

    }

}
