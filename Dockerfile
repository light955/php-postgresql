FROM php:8.0-apache

# Install necessary packages and PHP extensions
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Copy project files into the container
COPY ./html /var/www/html

# Set the working directory
WORKDIR /var/www/html