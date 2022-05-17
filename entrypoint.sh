#!/usr/bin/env bash
nginx

/usr/bin/supervisord -c /etc/supervisord.conf

cd /var/www/app; \
  php artisan optimize:clear; \
  php artisan optimize;


tail -f /dev/null

