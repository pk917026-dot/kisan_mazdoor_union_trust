#!/bin/sh
php artisan storage:link || true
php artisan config:cache
php artisan route:clear
php artisan view:clear
exec apache2-foreground
