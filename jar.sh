#!/bin/sh
/bin/rm -f nhz.jar 
jar cf nhz.jar -C classes . || exit 1

echo "nhz.jar generated successfully"
