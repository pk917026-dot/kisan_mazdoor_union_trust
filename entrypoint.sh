#!/usr/bin/env bash
set -e

# अगर APP_KEY खाली है तो नया key generate कर दो
if [ -z "$APP_KEY" ]; then
  php artisan key:generate --force
fi

# Migrations चलाओ (SQLite file में tables बनेंगे)
php artisan migrate --force || true

# Config / routes cache
php artisan config:cache || true
php artisan route:cache || true

# Apache start
exec apache2-foreground
