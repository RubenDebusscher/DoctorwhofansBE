#!/bin/bash
set -e

LOCAL_DIR=$(pwd)
LOG_FILE="../pull.log"
DRY_RUN=false

if [[ "$1" == "--dry-run" ]]; then
  DRY_RUN=true
  echo "🚧 Dry run actief – er worden GEEN downloads uitgevoerd."
fi

# Controleer vereiste variabelen
for var in HOSTING_HOST HOSTING_USER HOSTING_PASS HOSTING_DIR HOSTING_PORT; do
  if [ -z "${!var}" ]; then
    echo "❌ Fout: Variabele $var is niet ingesteld."
    exit 1
  fi
done

echo "$(date '+%Y-%m-%d %H:%M:%S') - Start pull user content..." | tee "$LOG_FILE"

# Functie om een folder te pullen
pull_folder() {
  local folder=$1
  local local_path="$LOCAL_DIR/$folder"

  mkdir -p "$local_path"
  echo "⬇️ Pulling folder: $folder"

  # Mirror opties
  local MIRROR_OPTS="--continue \
                     --only-newer \
                     --no-perms \
                     --no-umask \
                     --exclude-glob '.dataface_history/**' \
                     --exclude-glob 'cache/**' \
                     --exclude-glob '.env' \
                     --exclude-glob '**/.env' \
                     --verbose=1"

  if $DRY_RUN; then
    MIRROR_OPTS="$MIRROR_OPTS --dry-run"
  fi

  # LFTP pull met overzicht van gewijzigde bestanden
  lftp -u "$HOSTING_USER","$HOSTING_PASS" -p "$HOSTING_PORT" sftp://"$HOSTING_HOST" <<EOF 2>&1 | grep -E 'Transferring file|Removing old file|Directory|^Error' | tee -a "$LOG_FILE"
set sftp:auto-confirm yes
set cmd:fail-exit yes
set net:timeout 30
set net:max-retries 2

cd "$HOSTING_DIR"
mirror $MIRROR_OPTS "$folder" "$local_path"

bye
EOF
}

# Lijst met mappen om te pullen
for folder in images Video forum kanboard QR; do
  pull_folder "$folder"
done

echo "$(date '+%Y-%m-%d %H:%M:%S') - ✅ Pull user content voltooid." | tee -a "$LOG_FILE"
