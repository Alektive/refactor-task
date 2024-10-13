#!/usr/bin/env sh

set -o nounset
set -o errexit

# ----------------------------------------------------------------
# Environments
# ----------------------------------------------------------------

APP_PATH=${APP_PATH:-/var/www}
APP_UID=${APP_UID:-1000}

# ----------------------------------------------------------------
# Runtime
# ----------------------------------------------------------------

# Install composer packages
composer install --working-dir="$APP_PATH"

# Initialize environments
if [ ! -f "$APP_PATH/.env" ]; then
    cp "$APP_PATH/.env.example" "$APP_PATH/.env"
    php "$APP_PATH/artisan" key:generate
fi

# Run artisan commands
php "$APP_PATH/artisan" config:clear
php "$APP_PATH/artisan" event:clear
php "$APP_PATH/artisan" route:clear
php "$APP_PATH/artisan" view:clear

# Run artisan migrations
php "$APP_PATH/artisan" migrate

# Fix owner
chown -R "$APP_UID": "$APP_PATH"
