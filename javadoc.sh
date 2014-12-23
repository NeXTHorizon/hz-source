#!/bin/sh
CP=nhz.jar:lib/*:conf
SP=src/java/

/bin/rm -rf html/doc/*

javadoc -quiet -sourcepath $SP -classpath $CP -protected -splitindex -subpackages nhz -d html/doc/
