#!/bin/bash

mkdir -p "/tmp/GitHub/docker.folder/source/docker.folder/usr/local/emhttp/plugins/docker.folder/"

cp /usr/local/emhttp/plugins/docker.folder/* /tmp/GitHub/docker.folder/source/docker.folder/usr/local/emhttp/plugins/docker.folder -R -v -p
cd /tmp/GitHub/docker.folder/source/docker.folder/usr/local/emhttp/plugins/docker.folder
rm -f  ca.md5
find . -type f -exec md5sum {} + > /tmp/ca.md5
mv /tmp/ca.md5 ca.md5


