FROM php:8.2-apache

RUN apt-get update && apt-get install -y libicu-dev libzip-dev \
    && docker-php-ext-install pdo_mysql intl zip \
    && a2enmod rewrite

# Change document root for Apache
RUN sed -i -e 's|/var/www/html|/var/www/html/backend/web|g' /etc/apache2/sites-available/000-default.conf
