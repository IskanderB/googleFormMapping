FROM php:8.1-fpm

RUN apt-get update && apt-get upgrade -y \
    supervisor \
    git curl wget \
    libpq-dev libonig-dev libmemcached-dev libmcrypt-dev libxml2-dev \
    libfreetype6-dev libjpeg62-turbo-dev libpng-dev zlib1g-dev libicu-dev g++ gcc make libzip-dev zip \
    && apt-get install apt-utils -y \
    && apt-get install git zip vim libzip-dev libgmp-dev libffi-dev libssl-dev cron unoconv pdftohtml -y \
    && pecl install xdebug \
    && pecl install -o -f memcached \
    && rm -rf /tmp/pear \
    && docker-php-ext-install -j$(nproc) opcache mbstring pdo pdo_pgsql pgsql sockets zip gmp pcntl bcmath ffi pcntl shmop ftp intl gd \
    && docker-php-source delete \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-enable memcached \
    && apt-get autoremove --purge -y && apt-get autoclean -y && apt-get clean -y

RUN mkdir -p "/etc/supervisor/logs"

COPY ./worker.conf /etc/supervisor/conf.d/worker.conf

ENTRYPOINT ["/usr/bin/supervisord", "--nodaemon"]
