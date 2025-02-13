<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PerfilController;
use App\Http\Middleware\VerifyAuth;
use Illuminate\Support\Facades\Route;

Route::name('perfil.')->prefix('perfil')->group(function() {
    Route::middleware([VerifyAuth::class . ':all'])->group(function() {
        Route::get('/', [PerfilController::class, 'perfil'])->name('index');
        Route::patch('/update', [PerfilController::class, 'perfilUpdate'])->name('update');
    });
});

Route::name('reports.')->prefix('reports')->group(function() {
    Route::middleware([VerifyAuth::class . ':all'])->group(function() {
        Route::get('/', [FeedbackController::class, 'index'])->name('index');
        Route::post('/', [FeedbackController::class, 'store'])->name('store');
    });
});

// Carregar rotas específicas
require base_path('routes/aluno.php');
require base_path('routes/professor.php');
