FROM php:8.2.7-fpm-bookworm


RUN apt-get update && apt-get install -y \
      apt-utils \
      libpq-dev \
      libpng-dev \
      libzip-dev \
      zip unzip \
      git && \
      docker-php-ext-install pdo_mysql && \
      docker-php-ext-install bcmath && \
      docker-php-ext-install gd && \
      docker-php-ext-install zip && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

#COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin


#Installing xdebug
#RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
#    && apk add --update linux-headers \
#    && pecl install xdebug-3.2.2 \
#    && docker-php-ext-enable xdebug \
#    && apk del -f .build-deps \

# RUN apk add --no-cache linux-headers  \
#    && apk add --update --no-cache --virtual .build-dependencies $PHPIZE_DEPS \
#    && pecl install xdebug \
#    && docker-php-ext-enable xdebug \
#    && pecl clear-cache \
#    && apk del .build-dependencies

 RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY ./_docker/app /usr/local/etc/php/conf.d

WORKDIR /var/www
