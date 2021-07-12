FROM php:7.4-fpm-alpine
WORKDIR /application
EXPOSE 9000

RUN apk --no-cache add \
    bash \
    ca-certificates \
    curl \
    openssl \
    nodejs \
    npm \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && docker-php-ext-install pdo pdo_mysql

COPY php-ini-overrides.ini $PHP_INI_DIR/conf.d/99-overrides.ini

CMD ["php-fpm"]