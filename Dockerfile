FROM php:7.1

RUN docker-php-ext-install pdo pdo_mysql && cp ./env.sample ./.env