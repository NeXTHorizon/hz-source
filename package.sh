#!/bin/sh
VERSION=$1
PACKAGE=hz-client-${VERSION}.zip

FILES="conf lib html MIT-license.txt run.sh run.bat run-tor.sh verify.sh changelogs README.txt README_win.txt NHZ_Wallet.url Dockerfile docker_start.sh classes nhz.jar src compile.sh win-compile.sh javadoc.sh package.sh mint.bat mint.sh"

./compile.sh
./jar.sh
rm -rf html/doc/*
./javadoc.sh

rm -rf nhz
rm -rf ${PACKAGE}
mkdir -p nhz/
cp -a ${FILES} nhz
for f in `find nxt/html -name *.html -o -name *.js -o -name *.css -o -name *.json -o -name *.ttf -o -name *.svg -o -name *.otf`
do
	gzip -9vc "$f" > "$f".gz
done
zip -X -r ${PACKAGE} nhz -x \*/.idea/\* \*/.gitignore \*/.git/\* \*.iml nhz/conf/nhz.properties nhz/conf/logging.properties
rm -rf nhz
