<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        \Carbon\Carbon::setLocale(config('app.locale', 'id'));
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            $this->app->register(\Laravel\Dusk\DuskServiceProvider::class);
        }
    }
}
