#!/bin/bash
set -e

cd /var/www/html

# अगर .env नहीं है तो .env.example से बना दो (local/dev में काम आएगा)
if [ ! -f ".env" ] && [ -f ".env.example" ]; then
  cp .env.example .env
fi

# Laravel caches clear
php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true

# अगर APP_KEY env से नहीं मिला और .env में नहीं है तो generate कर दो
if [ -z "$APP_KEY" ]; then
  php artisan key:generate --force || true
fi

# अगर sqlite use कर रहे हो तो migrate run कर दो (error आए तो service ना रुके)
php artisan migrate --force || true

# आखिर में Apache start करो
exec apache2-foreground
