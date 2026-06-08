# ---- Stage 1: Build frontend assets with official Node image ----
FROM node:20-slim AS node-builder

WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY vite.config.js postcss.config.js tailwind.config.js ./
COPY resources ./resources
RUN npm run build

# ---- Stage 2: PHP application ----
FROM php:8.2-fpm

# System dependencies (NO NodeSource needed)
RUN apt-get update && apt-get install -y \
    nginx supervisor curl zip unzip git \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Copy built frontend assets from node stage
COPY --from=node-builder /app/public/build ./public/build

# Create .env file for build (artisan commands need it)
RUN cp .env.example .env || true

RUN composer install --no-dev --optimize-autoloader --no-interaction

# Generate app key if not set
RUN php artisan key:generate --force || true

RUN mkdir -p /var/log/supervisor \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

RUN rm -f /etc/nginx/sites-enabled/default
COPY docker/nginx.conf /etc/nginx/sites-enabled/laravel.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Make entrypoint executable
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 10000
CMD ["/entrypoint.sh"]