<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS in production (behind Render's reverse proxy)
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Share settings globally with all views
        if (! $this->app->runningInConsole()) {
            try {
                $settings = \App\Models\Setting::all()->pluck('value', 'key')->toArray();
                view()->share('site_settings', $settings);
            } catch (\Exception $e) {
                // Table might not exist yet during initial setup
            }
        }
    }
}
