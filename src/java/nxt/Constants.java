package nxt;

import nxt.util.Logger;

import java.util.Calendar;
import java.util.TimeZone;

public final class Constants {

    public static final int BLOCK_HEADER_LENGTH = 232;
    public static final int MAX_NUMBER_OF_TRANSACTIONS = 255;
    public static final int MAX_PAYLOAD_LENGTH = MAX_NUMBER_OF_TRANSACTIONS * 176;
    public static final long MAX_BALANCE_NXT = 1000000000;
    public static final long ONE_NXT = 100000000;
    public static final long MAX_BALANCE_NQT = MAX_BALANCE_NXT * ONE_NXT;
    public static final long INITIAL_BASE_TARGET = 153722867;
    public static final long MAX_BASE_TARGET = MAX_BALANCE_NXT * INITIAL_BASE_TARGET;
    public static final int MAX_ROLLBACK = Nxt.getIntProperty("nxt.maxRollback");
    static {
        if (MAX_ROLLBACK < 1441) {
            Logger.logErrorMessage("nxt.maxRollback must be at least 1441");
            throw new RuntimeException("nxt.maxRollback must be at least 1441");
        }
    }

    public static final int MAX_TIMEDRIFT = 15; // allow up to 15 s clock difference
    public static final int FORGING_DELAY = Nxt.getIntProperty("nxt.forgingDelay");
    public static final int FORGING_SPEEDUP = Nxt.getIntProperty("nxt.forgingSpeedup");

    public static final int MAX_ALIAS_URI_LENGTH = 1000;
    public static final int MAX_ALIAS_LENGTH = 100;

    public static final int MAX_ARBITRARY_MESSAGE_LENGTH = 1000;
    public static final int MAX_ENCRYPTED_MESSAGE_LENGTH = 1000;

    public static final int MAX_ACCOUNT_NAME_LENGTH = 100;
    public static final int MAX_ACCOUNT_DESCRIPTION_LENGTH = 1000;
    public static final int MAX_ACCOUNT_MESSAGE_PATTERN_LENGTH = 100;

    public static final long MAX_ASSET_QUANTITY_QNT = 1000000000L * 100000000L;
    public static final int MIN_ASSET_NAME_LENGTH = 3;
    public static final int MAX_ASSET_NAME_LENGTH = 10;
    public static final int MAX_ASSET_DESCRIPTION_LENGTH = 1000;
    public static final int MAX_ASSET_TRANSFER_COMMENT_LENGTH = 1000;

    public static final int MAX_POLL_NAME_LENGTH = 100;
    public static final int MAX_POLL_DESCRIPTION_LENGTH = 1000;
    public static final int MAX_POLL_OPTION_LENGTH = 100;
    public static final int MAX_POLL_OPTION_COUNT = 100;

    public static final int MAX_DGS_LISTING_QUANTITY = 1000000000;
    public static final int MAX_DGS_LISTING_NAME_LENGTH = 100;
    public static final int MAX_DGS_LISTING_DESCRIPTION_LENGTH = 1000;
    public static final int MAX_DGS_LISTING_TAGS_LENGTH = 100;
    public static final int MAX_DGS_GOODS_LENGTH = 10240;

    public static final int MAX_HUB_ANNOUNCEMENT_URIS = 100;
    public static final int MAX_HUB_ANNOUNCEMENT_URI_LENGTH = 1000;
    public static final long MIN_HUB_EFFECTIVE_BALANCE = 100000;

    public static final int MIN_CURRENCY_NAME_LENGTH = 3;
    public static final int MAX_CURRENCY_NAME_LENGTH = 10;
    public static final int MIN_CURRENCY_CODE_LENGTH = 3;
    public static final int MAX_CURRENCY_CODE_LENGTH = 5;
    public static final int MAX_CURRENCY_DESCRIPTION_LENGTH = 1000;
    public static final long MAX_CURRENCY_TOTAL_SUPPLY = 1000000000L * 100000000L;
    public static final int MAX_MINTING_RATIO = 10000; // per mint units not more than 0.01% of total supply
    public static final byte MIN_NUMBER_OF_SHUFFLING_PARTICIPANTS = 3;
    public static final byte MAX_NUMBER_OF_SHUFFLING_PARTICIPANTS = 100;
    public static final short MIN_SHUFFLING_DELAY = 5;
    public static final short MAX_SHUFFLING_DELAY = 1440;
    public static final int MAX_SHUFFLING_RECIPIENTS_LENGTH = 10000;

    public static final boolean isTestnet = Nxt.getBooleanProperty("nxt.isTestnet");
    public static final boolean isOffline = Nxt.getBooleanProperty("nxt.isOffline");
    public static final boolean dontForge = Nxt.getBooleanProperty("nxt.dontForge");

    public static final int ALIAS_SYSTEM_BLOCK = (isTestnet ? 0 : 22 );
    public static final int TRANSPARENT_FORGING_BLOCK = (isTestnet ? 0 : 30);
    public static final int ARBITRARY_MESSAGES_BLOCK = (isTestnet ? 0 : 40);
    public static final int TRANSPARENT_FORGING_BLOCK_2 = (isTestnet ? 0 : 47);
    public static final int TRANSPARENT_FORGING_BLOCK_3 = (isTestnet ? 0 : 51);
    public static final int TRANSPARENT_FORGING_BLOCK_4 = (isTestnet ? 0 : 64);
    public static final int TRANSPARENT_FORGING_BLOCK_5 = (isTestnet ? 0 : 67);
    public static final int BLOCK_1000 = 1000;
    public static final int TRANSPARENT_FORGING_BLOCK_6 =  (isTestnet ? 0 : 65000);
    public static final int TRANSPARENT_FORGING_BLOCK_7 =  Integer.MAX_VALUE;
    public static final int TRANSPARENT_FORGING_BLOCK_8 = Integer.MAX_VALUE;  //TODO
    public static final int NQT_BLOCK = (isTestnet ? 1 : 67000);
    public static final int ASSET_EXCHANGE_BLOCK = (isTestnet ? 0 : 70000);
    public static final int REFERENCED_TRANSACTION_FULL_HASH_BLOCK = (isTestnet ? 1 : 75000);
    public static final int REFERENCED_TRANSACTION_FULL_HASH_BLOCK_TIMESTAMP = Integer.MAX_VALUE;
    public static final int VOTING_SYSTEM_BLOCK = Integer.MAX_VALUE;
    public static final int TRANSACTIONS_VERSION_1_BLOCK =  (isTestnet ? 580 : 275000);
    public static final int DIGITAL_GOODS_STORE_BLOCK = Integer.MAX_VALUE; // dgs transactions are disabled
    public static final int PUBLIC_KEY_ANNOUNCEMENT_BLOCK = Integer.MAX_VALUE; // never force pk
    public static final int MONETARY_SYSTEM_BLOCK = Integer.MAX_VALUE;
    public static final int LAST_KNOWN_BLOCK = isTestnet ? 50000 : 355000;

    public static final int[] MIN_VERSION = new int[] {3, 8};

    static final long UNCONFIRMED_POOL_DEPOSIT_NQT = (isTestnet ? 50 : 100) * ONE_NXT;

    public static final long EPOCH_BEGINNING;
    static {
        Calendar calendar = Calendar.getInstance(TimeZone.getTimeZone("UTC"));
        calendar.set(Calendar.YEAR, 2014);
        calendar.set(Calendar.MONTH, Calendar.MARCH);
        calendar.set(Calendar.DAY_OF_MONTH, 22);
        calendar.set(Calendar.HOUR_OF_DAY, 22);
        calendar.set(Calendar.MINUTE, 22);
        calendar.set(Calendar.SECOND, 22);
        calendar.set(Calendar.MILLISECOND, 0);
        EPOCH_BEGINNING = calendar.getTimeInMillis();
    }

    public static final String ALPHABET = "0123456789abcdefghijklmnopqrstuvwxyz";
    public static final String ALLOWED_CURRENCY_CODE_LETTERS = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

    public static final int EC_RULE_TERMINATOR = 600; /* cfb: This constant defines a straight edge when "longest chain"
                                                        rule is outweighed by "economic majority" rule; the terminator
                                                        is set as number of seconds before the current time. */

    public static final int EC_BLOCK_DISTANCE_LIMIT = 60;

    private Constants() {} // never

}
