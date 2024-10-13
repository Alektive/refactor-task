
FROM php:8.0-fpm-alpine

COPY .docker/bin/ /opt/docker/bin/

ENV APP_PATH=/var/www \
    APP_UID=1000

RUN set -eux \
    # Create app user
    && adduser -u "$APP_UID" -D -S -G www-data app \
    # Install php extensions
    && apk add --no-cache --update \
        zlib-dev \
        libzip-dev \
        freetype-dev \
        libxml2-dev \
    && docker-php-ext-install \
        pdo \
        zip \
    # Install composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer-2 \
    && ln -sf /usr/local/bin/composer-2 /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer* \
    # Prepare entrypoint
    && ln -sf /opt/docker/bin/docker-entrypoint.sh /docker-entrypoint.sh \
    && mkdir -p /docker-entrypoint.d \
    && ln -sf /opt/docker/bin/laravel-bootstrap.sh /docker-entrypoint.d/10-laravel-bootstrap.sh \
    && echo "[INFO] PHP-FPM: Entrypoint has been successfully initialized." \
    # Cleanup image
    && if [ -d /var/cache/apk ]; then rm -rf /var/cache/apk/*; fi \
    && if [ -d /var/cache/apk ]; then rm -rf /var/lib/apk/*; fi

WORKDIR $APP_PATH

USER app

STOPSIGNAL SIGQUIT

CMD ["php", "artisan", "serve", "--host", "0.0.0.0"]

ENTRYPOINT ["/docker-entrypoint.sh"]
