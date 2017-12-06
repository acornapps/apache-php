FROM php:7.0-apache
MAINTAINER Acornsoft

RUN apt-get update \
  && apt-get install -y mysql-client curl \
  && docker-php-ext-install mysqli \
  && apt-get clean \
  && rm -rf /var/cache/apt/archives

COPY ./ /var/www/html
