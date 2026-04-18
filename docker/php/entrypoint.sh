#!/bin/sh
set -e

if [ ! -f /app/vendor/autoload.php ]; then
    composer install --no-scripts --prefer-dist
    composer dump-autoload --optimize
fi

exec "$@"