#!/bin/sh
java -cp classes nxt.tools.ManifestGenerator
/bin/rm -f nhz.jar
jar cfm nhz.jar resource/nxt.manifest.mf -C classes . || exit 1
/bin/rm -f nhzservice.jar
jar cfm nhzservice.jar resource/nxtservice.manifest.mf -C classes . || exit 1

echo "Horizon jar files generated successfully"