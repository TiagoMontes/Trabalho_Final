FROM php:8.1-fpm-alpine

WORKDIR /var/www/html

RUN apk --update --no-cache add git
RUN docker-php-ext-install pdo_mysql

RUN apk update
RUN apk upgrade
RUN apk add bash
RUN apk add tzdata

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV TZ="America/Sao_Paulo"
