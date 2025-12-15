#!/bin/bash
set -e

# === Config ===
LOCAL_DIR=$(pwd)
LOG_FILE="../deploy.log"
DRY_RUN=false

# === Check arguments ===
if [[ "$1" == "--dry-run" ]]; then
  DRY_RUN=true
  echo "🚧 Dry run actief – er worden GEEN uploads uitgevoerd."
fi

# === Check required environment variables ===
for var in HOSTING_HOST HOSTING_USER HOSTING_PASS HOSTING_DIR HOSTING_PORT; do
  if [ -z "${!var}" ]; then
    echo "❌ Fout: Variabele $var is niet ingesteld."
    exit 1
  fi
done


# === Logging start ===
echo "$(date '+%Y-%m-%d %H:%M:%S') - Start upload..." | tee "$LOG_FILE"

# === Mirror options ===
MIRROR_OPTS='--verbose=2 \
--only-newer \
--no-perms \
--no-umask \
--exclude-glob "**/.env*" \
--exclude-glob "**/.env.live" \
--exclude-glob "**/.env.test" \
--exclude-glob "**/.htaccess*" \
--exclude-glob "**/.htaccess.live" \
--exclude-glob "**/.htaccess.test" \
--exclude-glob ".git" \
--exclude-glob ".git/**" \
--exclude-glob ".github" \
--exclude-glob ".github/**" \
--exclude-glob "deploy.sh" \
--exclude-glob "node_modules/**" \
--exclude-glob ".vscode/**" \
--exclude-glob "README*" \
--exclude-glob "*.md" \
--exclude-glob "*.log"'


if $DRY_RUN; then
  MIRROR_OPTS="$MIRROR_OPTS --dry-run"
fi

# === Upload via LFTP ===
lftp -u "$HOSTING_USER","$HOSTING_PASS" -p "$HOSTING_PORT" sftp://"$HOSTING_HOST" <<EOF 2>&1 | tee -a "$LOG_FILE"
set sftp:auto-confirm yes
set cmd:fail-exit yes
set net:timeout 30
set net:max-retries 2

echo "🌍 Verbonden met $HOSTING_HOST"
echo "📂 Top-level remote directory:"
cls -1 $HOSTING_DIR

echo "⬆️ Start upload..."
mirror -R "$LOCAL_DIR" "$HOSTING_DIR" $MIRROR_OPTS

bye
EOF

# === Logging end ===
echo "$(date '+%Y-%m-%d %H:%M:%S') - ✅ Deploy voltooid." | tee -a "$LOG_FILE"
