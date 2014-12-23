#!/bin/sh
CP=conf/:classes/:lib/*:testlib/*
SP=src/java/:test/java/
TESTS="nhz.crypto.Curve25519Test nhz.crypto.ReedSolomonTest nhz.peer.HallmarkTest nhz.TokenTest"

/bin/mkdir -p classes/

javac -sourcepath $SP -classpath $CP -d classes/ src/java/nhz/*.java src/java/nhz/*/*.java test/java/nhz/*.java test/java/nhz/*/*.java || exit 1

java -classpath $CP org.junit.runner.JUnitCore $TESTS

/bin/rm -rf classes

