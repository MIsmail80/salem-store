<?php

namespace Webkul\SmsOtp\Providers;

use Illuminate\Support\ServiceProvider;

class SmsOtpServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'smsotp');

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'smsotp');

        $this->app->register(EventServiceProvider::class);
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/smsotp.php',
            'smsotp'
        );
    }
}
