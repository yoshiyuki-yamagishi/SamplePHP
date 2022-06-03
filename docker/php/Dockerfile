FROM php:8.0-apache
RUN apt update \
    && apt install -y g++ libicu-dev libzip-dev openssl libssl-dev zlib1g-dev libmemcached-dev zip unzip zlib1g-dev vim telnet \
	&& pecl install opcache memcached xdebug redis APCu \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-enable memcached
RUN a2enmod rewrite

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
