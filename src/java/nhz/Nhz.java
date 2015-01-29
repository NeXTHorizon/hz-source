package nhz;

import nhz.http.API;
import nhz.peer.Peers;
import nhz.user.Users;
import nhz.util.Logger;
import nhz.util.ThreadPool;

import nhz.upnp.GatewayDevice;
import nhz.upnp.GatewayDiscover;
import nhz.upnp.PortMappingEntry;

import java.io.FileInputStream;
import java.io.IOException;
import java.io.InputStream;
import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import java.util.Properties;

import java.net.InetAddress;

public final class Nhz {

	//be careful PeerImpl.java will only connect to versions starting with 'NHZ'
    public static final String VERSION = "NHZ V3.8";
    public static final String APPLICATION = "NRS";

    private static final Properties defaultProperties = new Properties();
    static {
        System.out.println("Initializing Nhz server version " + Nhz.VERSION);
        try (InputStream is = ClassLoader.getSystemResourceAsStream("nhz-default.properties")) {
            if (is != null) {
                Nhz.defaultProperties.load(is);
            } else {
                String configFile = System.getProperty("nhz-default.properties");
                if (configFile != null) {
                    try (InputStream fis = new FileInputStream(configFile)) {
                        Nhz.defaultProperties.load(fis);
                    } catch (IOException e) {
                        throw new RuntimeException("Error loading nhz-default.properties from " + configFile);
                    }
                } else {
                    throw new RuntimeException("nhz-default.properties not in classpath and system property nhz-default.properties not defined either");
                }
            }
        } catch (IOException e) {
            throw new RuntimeException("Error loading nhz-default.properties", e);
        }
    }
    private static final Properties properties = new Properties(defaultProperties);
    static {
        try (InputStream is = ClassLoader.getSystemResourceAsStream("nhz.properties")) {
            if (is != null) {
                Nhz.properties.load(is);
            } // ignore if missing
        } catch (IOException e) {
            throw new RuntimeException("Error loading nhz.properties", e);
        }
    }

    public static int getIntProperty(String name) {
        try {
            int result = Integer.parseInt(properties.getProperty(name));
            Logger.logMessage(name + " = \"" + result + "\"");
            return result;
        } catch (NumberFormatException e) {
            Logger.logMessage(name + " not defined, assuming 0");
            return 0;
        }
    }

    public static String getStringProperty(String name) {
        return getStringProperty(name, null);
    }

    public static String getStringProperty(String name, String defaultValue) {
        String value = properties.getProperty(name);
        if (value != null && ! "".equals(value)) {
            Logger.logMessage(name + " = \"" + value + "\"");
            return value;
        } else {
            Logger.logMessage(name + " not defined");
            return defaultValue;
        }
    }

    public static List<String> getStringListProperty(String name) {
        String value = getStringProperty(name);
        if (value == null || value.length() == 0) {
            return Collections.emptyList();
        }
        List<String> result = new ArrayList<>();
        for (String s : value.split(";")) {
            s = s.trim();
            if (s.length() > 0) {
                result.add(s);
            }
        }
        return result;
    }

    public static Boolean getBooleanProperty(String name) {
        String value = properties.getProperty(name);
        if (Boolean.TRUE.toString().equals(value)) {
            Logger.logMessage(name + " = \"true\"");
            return true;
        } else if (Boolean.FALSE.toString().equals(value)) {
            Logger.logMessage(name + " = \"false\"");
            return false;
        }
        Logger.logMessage(name + " not defined, assuming false");
        return false;
    }

    public static Blockchain getBlockchain() {
        return BlockchainImpl.getInstance();
    }

    public static BlockchainProcessor getBlockchainProcessor() {
        return BlockchainProcessorImpl.getInstance();
    }

    public static TransactionProcessor getTransactionProcessor() {
        return TransactionProcessorImpl.getInstance();
    }

    public static void main(String[] args) {
        Runtime.getRuntime().addShutdownHook(new Thread(new Runnable() {
            @Override
            public void run() {
                Nhz.shutdown();
            }
        }));
        init();
    }

    public static void init(Properties customProperties) {
        properties.putAll(customProperties);
        init();
    }

    public static void init() {
        Init.init();
    }

    public static void upnp() throws Exception {
    	// UPNP START
		GatewayDiscover gatewayDiscover = new GatewayDiscover();
		Logger.logMessage("starting upnp detection");

		gatewayDiscover.discover();
	
		GatewayDevice activeGW = gatewayDiscover.getValidGateway();
		
		InetAddress localAddress = activeGW.getLocalAddress();
		Logger.logMessage("UPNP: local address: "+ localAddress.getHostAddress());
		String externalIPAddress = activeGW.getExternalIPAddress();
		Logger.logMessage("UPNP: external address: "+ externalIPAddress);

		PortMappingEntry portMapping = new PortMappingEntry();
		activeGW.getGenericPortMappingEntry(0,portMapping);
		
		if (activeGW.getSpecificPortMappingEntry(7774,"TCP",portMapping)) {
			Logger.logMessage("UPNP: Port "+7774+" is already mapped!");
			return;
		} else {
			Logger.logMessage("UPNP: sending port mapping request for port "+7774);
			activeGW.addPortMapping(7774,7774,localAddress.getHostAddress(),"TCP","NHZ");		
		} 
		// UPNP STOP
    }
    
    public static void shutdown() {
        Logger.logMessage("Shutting down...");
        API.shutdown();
        Users.shutdown();
        Peers.shutdown();
        TransactionProcessorImpl.getInstance().shutdown();
        ThreadPool.shutdown();
        Db.shutdown();
        Logger.logMessage("Nhz server " + VERSION + " stopped.");
        Logger.shutdown();
    }

    private static class Init {

        static {
            try {
                long startTime = System.currentTimeMillis();
                Logger.init();
    			if (Nhz.getBooleanProperty("nhz.enableUPNP")) {
    				try{
    					upnp();
    				} catch (Exception e) {
    						Logger.logMessage("upnp detection failed");
    				}
    			}
                Db.init();
                BlockchainProcessorImpl.getInstance();
                TransactionProcessorImpl.getInstance();
                Peers.init();
                Generator.init();
                API.init();
                Users.init();
                DebugTrace.init();
                ThreadPool.start();

                long currentTime = System.currentTimeMillis();
                Logger.logMessage("Initialization took " + (currentTime - startTime) / 1000 + " seconds");
                Logger.logMessage("Nhz server " + VERSION + " started successfully.");
                if (Constants.isTestnet) {
                    Logger.logMessage("RUNNING ON TESTNET - DO NOT USE REAL ACCOUNTS!");
                }
            } catch (Exception e) {
                Logger.logErrorMessage(e.getMessage(), e);
                System.exit(1);
            }
        }

        private static void init() {}

        private Init() {} // never

    }

    private Nhz() {} // never

}
