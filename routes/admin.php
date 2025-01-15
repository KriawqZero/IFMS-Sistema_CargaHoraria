<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\VerifyAuth;
use App\Http\Controllers\Admin\CsvController;

Route::name('admin.')->group(function() {
    Route::post('admin', [AdminController::class, 'processLogin'])->name('login.post');

    Route::middleware([VerifyAuth::class . ':admin'])->group(function() {
        Route::get('admin', [AdminController::class, 'showLoginForm'])->name('login');

        Route::get('admin/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('/admin/cadastrar-alunos', [CsvController::class, 'create'])->name('create.alunos');
        Route::post('/admin/cadastrar-alunos', [CsvController::class, 'store'])->name('create.alunos.post');
    });
});


