FROM php:8.2-fpm

RUN apt-get update && apt-get install -y wget cron supervisor libzip-dev zip libpq-dev libpng-dev

RUN docker-php-ext-install zip pdo pgsql pdo_pgsql mysqli pdo_mysql gd

RUN pecl install xdebug && docker-php-ext-enable xdebug

# Install Dockerize
ENV DOCKERIZE_VERSION v0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
  && tar -C /usr/local/bin -xzvf dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
  && rm dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz

# Install Composer
COPY --from=composer:2.4.0 /usr/bin/composer /usr/bin/composer

COPY php_conf.ini /usr/local/etc/php/conf.d/990-custom.ini