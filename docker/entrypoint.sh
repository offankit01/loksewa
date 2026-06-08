#!/bin/sh

# Optimized for Render deployment
echo "🚀 Starting deployment script..."

# Ensure storage directories exist with correct permissions
echo "📁 Setting up storage directories..."
mkdir -p storage/framework/cache/data \
         storage/framework/sessions \
         storage/framework/views \
         storage/logs \
         bootstrap/cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Generate key if APP_KEY is not set
if [ -z "$APP_KEY" ]; then
    echo "🔑 Generating application key..."
    php artisan key:generate --force
fi

# Cache configurations
echo "📦 Caching Laravel configurations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations (Safe for production with --force)
echo "📂 Running database migrations..."
php artisan migrate --force || echo "⚠️ Migration failed or no database configured yet"

# Link storage
php artisan storage:link || true

# Start Supervisord
echo "🏁 Starting Supervisor..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
