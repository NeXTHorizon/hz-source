#!/bin/sh
CP="conf/;classes/;lib/*"
SP=src/java/

/bin/rm -f nhz.jar
/bin/rm -rf classes
/bin/mkdir -p classes/

javac -sourcepath $SP -classpath $CP -d classes/ src/java/nxt/*.java src/java/nxt/*/*.java || exit 1

echo "Horizon class files compiled successfully"
