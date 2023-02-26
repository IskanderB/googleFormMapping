FROM php:8.1-fpm

RUN apt-get update && apt-get upgrade -y \
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

# Установим Symfony CLI
RUN wget https://get.symfony.com/cli/installer -O - | bash && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# Установим Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node
RUN curl -sL https://deb.nodesource.com/setup_16.x > setup_16.x \
    && chmod +x setup_16.x \
    && ./setup_16.x \
    && apt install -y nodejs

# Install Yarn
RUN curl -sL https://dl.yarnpkg.com/debian/pubkey.gpg | gpg --dearmor | tee /usr/share/keyrings/yarnkey.gpg >/dev/null \
    && echo "deb [signed-by=/usr/share/keyrings/yarnkey.gpg] https://dl.yarnpkg.com/debian stable main" | tee /etc/apt/sources.list.d/yarn.list \
    && apt-get update && apt-get install yarn

COPY ./docker-entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]

CMD ["php-fpm"]
