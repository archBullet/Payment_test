FROM php:8.2-fpm-alpine

RUN apk --no-cache add bash

RUN docker-php-ext-install pdo pdo_mysql

COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini