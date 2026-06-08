FROM php:8.2-fpm
 
# System dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    supervisor \
    curl \
    zip \
    unzip \
    git \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Node.js
RUN apt-get update && apt-get install -y nodejs npm \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*
# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
 
# App files
WORKDIR /var/www/html
COPY . .
 
# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction
 
# Build frontend assets
RUN npm install && npm run build
 
# Permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache
 
# Nginx config
RUN rm -f /etc/nginx/sites-enabled/default
COPY docker/nginx.conf /etc/nginx/sites-enabled/laravel.conf
 
# Supervisor config
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
 
EXPOSE 80
 
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]