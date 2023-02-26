#!/bin/bash
set -e

echo "date.timezone='Europe/Moscow'" > /usr/local/etc/php/conf.d/timezone.ini
echo "memory_limit=1024M" > /usr/local/etc/php/php.ini

if [[ "$PHP_XDEBUG_MODE" != "" ]]; then
    echo 'xdebug.mode='$PHP_XDEBUG_MODE >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
    echo 'xdebug.start_with_request=yes' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
    echo 'xdebug.client_host='$PHP_XDEBUG_CLIENT_HOST >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
    echo 'xdebug.client_port='$PHP_XDEBUG_CLIENT_PORT >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
    echo -e "XDebug enabled on $PHP_XDEBUG_CLIENT_HOST:$PHP_XDEBUG_CLIENT_PORT"
else
    echo '' > /usr/local/etc/php/conf.d/xdebug.ini
    echo -e "XDebug disabled!"
fi

exec "$@"
