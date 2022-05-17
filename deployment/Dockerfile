FROM eastplayers/php-fpm:latest
EXPOSE 80

# define workdir
WORKDIR /var/www/app

# Copy project source
COPY --chown=www-data . /var/www/app

# Copy project config
COPY ./deployment/config/nginx-conf/nginx.conf /etc/nginx/http.d/default.conf
# Copy entrypoint
COPY ./entrypoint.sh /etc/entrypoint.sh

RUN mkdir -p /run/nginx

RUN set -eux; \
    cd /var/www/app; \
    cp deployment/config/php-fpm/zz-esp-php.ini /usr/local/etc/php/conf.d; \
    cp deployment/config/php-fpm/zz-esp-fpm.conf /usr/local/etc/php-fpm.d; \
    cp deployment/config/supervisor/supervisord.conf /etc/supervisord.conf; \
    composer install \
        --quiet \
        --prefer-dist \
        --no-interaction \
        --optimize-autoloader \
        --dev;

RUN mkdir -p /var/log/php-fpm

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
ENTRYPOINT ["/etc/entrypoint.sh"]
