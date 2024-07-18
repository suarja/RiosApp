# syntax=docker/dockerfile:1

FROM composer:lts as deps
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

FROM php:8.3.9-apache as final

RUN a2enmod rewrite
RUN docker-php-ext-install pdo pdo_mysql
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

# Copy custom Apache configuration files
COPY ./ports.conf /etc/apache2/ports.conf
COPY ./000-default.conf /etc/apache2/sites-available/000-default.conf

# Ensure the server name is set to suppress the message
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf


# Copy the app files from the project directory.
COPY . /var/www/html

# Switch to a non-privileged user
USER www-data
