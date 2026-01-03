FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip libpq-dev libonig-dev libzip-dev zip \
    nginx supervisor \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy app files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel setup
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

# Copy Nginx and Supervisor configs
COPY ./docker/nginx.conf /etc/nginx/sites-enabled/default
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expose port 8080 (Render uses $PORT)
EXPOSE 8080

# Start Supervisor (runs both Nginx + PHP-FPM)
CMD ["/usr/bin/supervisord", "-n"]