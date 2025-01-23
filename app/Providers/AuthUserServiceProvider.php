<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AuthUserServiceProvider extends ServiceProvider {
    /**
     * Register services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {
        View::composer(['*'], function ($view) {
            if (!in_array($view->getName(), ['login'])) {
                $user = auth('professor')->user() ?? auth('aluno')->user();
                $view->with('usuarioLogado', $user);
            }
        });
    }
}
