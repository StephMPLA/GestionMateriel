FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    libicu-dev libzip-dev libpq-dev unzip git \
    && docker-php-ext-install intl zip opcache pdo_pgsql \
    && a2enmod rewrite
    
RUN printf '<Directory /var/www/html/public>\nAllowOverride All\nRequire all granted\n</Directory>\n' > /etc/apache2/conf-available/symfony.conf \
    && a2enconf symfony

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri 's!/var/www/html!/var/www/html/public!g' \
    /etc/apache2/sites-available/*.conf

WORKDIR /var/www/html