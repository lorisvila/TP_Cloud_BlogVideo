FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Set working directory
WORKDIR /var/www/html
RUN chown -R www-data:www-data /var/www/html

EXPOSE 8080

