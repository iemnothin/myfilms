FROM php:8.2-fpm

# Install dependencies dan ekstensi pdo_mysql
RUN docker-php-ext-install pdo pdo_mysql

# Set working directory
WORKDIR /var/www
