#!/bin/bash
# Zet script uitvoerbaar: chmod +x deploy.sh

# Stop script bij fouten
set -e

# Ga naar de repo map
cd /mnt/test/DoctorWhofansBE || exit 1

echo "Gebruik live .htaccess voor deze deploy..."
cp .htaccess.live .htaccess

echo "Start upload naar hosting..."
# Upload via lftp SFTP
lftp -u "$SFTP_USER","$SFTP_PASS" sftp://$SFTP_HOST <<EOF
mirror -R ./ $REMOTE_DIR \
  --exclude-glob .git \
  --exclude-glob *.env \
  --exclude-glob *.log \
  --exclude-glob .htaccess          # Optioneel: overschrijf alleen met live versie
bye
EOF

echo "Deploy klaar!"
