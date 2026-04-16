FROM php:8.4-cli-alpine

RUN apk add --no-cache \
    git \
    unzip \
    curl \
    libpq-dev \
    docker-cli \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock* ./
RUN composer install --no-scripts --no-autoloader --prefer-dist

COPY . .
RUN composer dump-autoload --optimize

CMD ["php", "bin/mcp-server.php"]
