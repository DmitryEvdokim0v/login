FROM php:8.2.12-fpm-alpine3.18

WORKDIR /var/www

ENV TZ=Asia/Almaty

RUN set -eux; apk add --no-cache --virtual .temp $PHPIZE_DEPS tzdata shadow \
    linux-headers icu-dev libpng-dev libpq-dev libzip-dev libxml2-dev libjpeg-turbo-dev; \
    apk add --no-cache icu libjpeg-turbo libpng libpq libzip; \
    docker-php-ext-configure gd --enable-gd --with-jpeg; docker-php-ext-configure zip --with-zip; \
    docker-php-ext-install -j$(nproc) gd bcmath intl opcache pcntl pdo_pgsql pdo_mysql soap zip; \
    pecl install -o -f redis xdebug xmlrpc; docker-php-ext-enable redis xdebug xmlrpc; \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer; \
    chmod +x /usr/local/bin/composer; \
    ENV PATH="/usr/local/bin:${PATH}" \
    groupmod -o -g 1000 www-data; usermod -o -u 1000 -g www-data www-data; \
    chown -R www-data:www-data /var/www; docker-php-source delete; apk del .temp; \
    rm -rf /tmp/* /var/tmp/* /var/cache/apk/* /var/www/html/* /usr/share/doc/* /usr/share/man/*

COPY ./php.ini /usr/local/etc/php/conf.d/custom.ini

USER www-data

EXPOSE 9000
