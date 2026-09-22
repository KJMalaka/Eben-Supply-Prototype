#!/usr/bin/env bash
set -e

# Render assigns the public port via $PORT (defaults to 10000); Apache's
# packaged config always listens on 80, so rewrite it at container start.
: "${PORT:=10000}"
sed -i "s/80/${PORT}/g" /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan migrate --force

exec "$@"
