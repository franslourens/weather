FROM php:8.1-fpm

ARG user
ARG uid

RUN addgroup --gid $uid --system $user
RUN adduser --uid $uid --system --disabled-login --disabled-password --gid $uid $user

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

COPY ./docker-compose/php/www.conf /usr/local/etc/php-fpm.d/www.conf
RUN rm /usr/local/etc/php-fpm.d/zz-docker.conf

COPY ./docker-compose/php/php.ini /usr/local/etc/php

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN pecl install redis && docker-php-ext-enable redis

WORKDIR /var/www

COPY . .

RUN composer update