<?php

namespace Neverlxsss\Monobank;

use Illuminate\Support\ServiceProvider;

class MonobankServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/monobank.php' => config_path('monobank.php'),
        ]);
    }

    public function register(): void
    {
        $this->app->bind('monobank', function () {
            return new Monobank();
        });
    }

    public function provides(): array
    {
        return ['monobank'];
    }
}
