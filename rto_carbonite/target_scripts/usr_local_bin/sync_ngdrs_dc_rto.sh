#!/bin/bash

SRC_FILE="/var/log/ngdrs-dc_rto.log"
DEST_DIR="/var/log"
REMOTE_HOST="root@ngdrs-ag"
SSH_KEY="/root/.ssh/ngdrs-dc"  # Modify this path if your SSH key is different

inotifywait -m -e modify $SRC_FILE |
while read path _ file; do
    rsync -avz -e "ssh -i $SSH_KEY" $SRC_FILE $REMOTE_HOST:$DEST_DIR
done
