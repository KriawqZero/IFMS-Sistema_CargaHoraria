<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        Blade::componentNamespace('App\\View\\Components\\Master\\Alerts', 'alerts');
        Blade::componentNamespace('App\\View\\Components\\Utility\\Buttons', 'buttons');
    }
}
