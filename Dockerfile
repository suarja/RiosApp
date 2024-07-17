# syntax=docker/dockerfile:1

# Stage 1: Composer dependencies
FROM composer:lts as deps
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Stage 2: PHP Environment Setup
FROM php:8.3.9-apache as final

# Enable Apache Rewrite Module
RUN a2enmod rewrite

# Update Apache configuration to allow .htaccess overrides
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Install PHP extensions (example for gd)
RUN apt-get update && apt-get install -y \
    libfreetype-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Use the default production configuration for PHP
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Copy the app dependencies from the previous install stage.
COPY --from=deps /app/vendor/ /var/www/html/vendor

# Copy the app files from the project directory.
COPY . /var/www/html

# Switch to a non-privileged user
USER www-data
