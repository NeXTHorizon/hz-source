#!/bin/sh
CP=classes:lib/*:conf
SP=src/java/

/bin/rm -rf html/doc/*

javadoc -quiet -sourcepath $SP -classpath $CP -package -splitindex -subpackages nxt -d html/doc/
