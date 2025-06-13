FROM php:8.1.0-apache
WORKDIR /var/www/html

# Enable Mod Rewrite
RUN a2enmod rewrite

# Install required libraries
RUN apt-get update -y && apt-get install -y \
    libicu-dev \
    libmariadb-dev \
    unzip zip \
    zlib1g-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libpq-dev  
RUN apt-get install -y postgresql-server-dev-all

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP Extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo_pgsql pgsql

# Expose port 80 for Apache
EXPOSE 80

# Set permissions (optional, based on your project needs)
# RUN chown -R www-data:www-data /var/www/html \
#     && chmod -R 755 /var/www/html/storage \
#     && chmod -R 755 /var/www/html/bootstrap/cache

# Run migrations
CMD ["sh", "-c", "php artisan migrate  && apache2-foreground"]
