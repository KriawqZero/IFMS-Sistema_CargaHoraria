<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\VerifyAuth;

Route::name('admin.')->group(function() {
    Route::get('admin', [AdminController::class, 'showLoginForm'])->name('login');

    Route::post('admin', [AdminController::class, 'processLogin'])->name('login.post');

    Route::middleware([VerifyAuth::class . ':admin'])->group(function() {
        Route::get('admin/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');
    });
});


