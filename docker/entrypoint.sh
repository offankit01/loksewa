#!/bin/sh

# Optimized for Render deployment
echo "🚀 Starting deployment script..."

# Cache configurations
echo "📦 Caching Laravel configurations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations (Safe for production with --force)
echo "📂 Running database migrations..."
php artisan migrate --force

# Start Supervisord
echo "🏁 Starting Supervisor..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
