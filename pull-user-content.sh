#!/bin/bash
PROJECT_DIR="/mnt/test/DoctorWhofansBE"
REMOTE_DIR="$HOSTING_DIR"
LOCAL_DIR="$PROJECT_DIR"

SFTP_HOST="$HOSTING_HOST"
SFTP_USER="$HOSTING_USER"
SFTP_PASS="$HOSTING_PASS"

# maak een tijdelijke exclude lijst gebaseerd op .gitignore
EXCLUDE_FILE=$(mktemp)
grep -v '^#' "$PROJECT_DIR/.gitignore" | grep -v '^$' > "$EXCLUDE_FILE"

EXCLUDE_ARGS=""
while IFS= read -r line; do
    EXCLUDE_ARGS="$EXCLUDE_ARGS --exclude-glob $line"
done < "$EXCLUDE_FILE"
rm $EXCLUDE_FILE

# lftp mirror alles buiten Git
LFTP_SCRIPT=$(mktemp)
echo "open -u $SFTP_USER,$SFTP_PASS sftp://$SFTP_HOST" > $LFTP_SCRIPT
echo "mirror --verbose --only-newer $EXCLUDE_ARGS $REMOTE_DIR $LOCAL_DIR" >> $LFTP_SCRIPT
echo "bye" >> $LFTP_SCRIPT

lftp -f $LFTP_SCRIPT
rm $LFTP_SCRIPT
