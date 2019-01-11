FROM php:7.2-fpm

RUN apt-get update

RUN apt-get install -y acl gettext git libicu-dev libgmp-dev libpng-dev libpq-dev libxml2-dev nano unzip zlib1g-dev

RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl bcmath gd gmp json mbstring xml zip

# Install XDebug
RUN pecl install xdebug-2.6.0 && docker-php-ext-enable xdebug
RUN mkdir /var/log/xdebug

# MongoDB
RUN pecl install mongodb && docker-php-ext-enable mongodb


# Install Composer
RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

# Set timezone
RUN rm /etc/localtime
RUN ln -s /usr/share/zoneinfo/Europe/Oslo /etc/localtime
RUN "date"

WORKDIR /var/www/symfony
