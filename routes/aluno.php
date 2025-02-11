<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Aluno\AlunoCertificadoController;
use App\Http\Controllers\Aluno\AlunoController;
use App\Http\Middleware\VerifyAuth;
use App\Http\Middleware\VerifyJWT;

// Grupo de rotas do aluno (nomes prefixados com 'aluno.')
Route::name('aluno.')->group(function() {
    // Rota de formulario de login do aluno
    Route::get('/login', [AlunoController::class, 'showLoginForm'])
        ->middleware([VerifyAuth::class . ':none'])
        ->name('login');

    Route::post('/login', [AlunoController::class, 'processLogin'])
        ->middleware([VerifyJWT::class, VerifyAuth::class . ':none'])
        ->name('login.post');

    // Rota de logout do aluno
    Route::get('aluno/logout', [AlunoController::class, 'logout'])
        ->name('logout');

    // Grupo de rotas protegidas por autenticação do aluno
    Route::middleware([VerifyAuth::class . ':aluno'])->group(function() {
        // Rota de dashboard do aluno
        Route::get('/', [AlunoController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('aluno/sobre', [AlunoController::class, 'sobre'])
        ->name('sobre');

        // Rotas de certificados do aluno
        Route::prefix('aluno/certificados')->name('certificados.')->group(function() {
            // Rota para criar/ enviar certificado
            Route::get('/', [AlunoCertificadoController::class, 'index'])->name('index');
            Route::get('/enviar', [AlunoCertificadoController::class, 'create'])->name('create');
            Route::post('/enviar', [AlunoCertificadoController::class, 'store'])->name('store');
            Route::delete('/delete/{id}', [AlunoCertificadoController::class, 'destroy'])->name('destroy');
        });
    });
});
