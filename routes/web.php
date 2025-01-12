<?php

use App\Http\Controllers\Aluno\AlunoController;
use App\Http\Controllers\Professor\ProfessorController;
use App\Http\Controllers\Aluno\AlunoCertificadoController;
use App\Http\Controllers\Professor\ProfessorCertificadoController;
use App\Http\Middleware\VerifyAuth;
use App\Http\Middleware\VerifyJWT;
use Illuminate\Support\Facades\Route;

// Grupo de rotas do aluno (nomes prefixados com 'aluno.')
Route::name('aluno.')->group(function() {
    Route::post('/', [AlunoController::class, 'processLogin'])
        ->middleware(VerifyJWT::class)
        ->name('login.post');

    // Rota de logout do aluno
    Route::get('aluno/logout', [AlunoController::class, 'logout'])
        ->name('logout');

    Route::get('aluno/sobre', [AlunoController::class, 'sobre'])
        ->name('sobre');

    // Grupo de rotas protegidas por autenticação do aluno
    Route::middleware([VerifyAuth::class . ':aluno'])->group(function() {
        // Rota de formulario de login do aluno
        Route::get('/', [AlunoController::class, 'showLoginForm'])
            ->name('login');

        // Rota de dashboard do aluno
        Route::get('aluno', [AlunoController::class, 'dashboard'])
            ->name('dashboard');

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

// Grupo de rotas do professor (nomes prefixados com 'professor.')
Route::name('professor.')->group(function() {
    // Rota de formulario de login do professor
    Route::get('professor', [ProfessorController::class, 'showLoginForm'])
        ->name('login');

    // Rota de processamento do login do professor
    Route::post('professor', [ProfessorController::class, 'processLogin'])
        ->name('login.post');

    // Grupo de rotas protegidas por autenticação
    Route::middleware([VerifyAuth::class . ':professor'])->group(function() {
        // Rota de dashboard do professor
        Route::get('professor/dashboard', [ProfessorController::class, 'dashboard'])
            ->name('dashboard');

        // Rotas de certificados do professor
        Route::prefix('professor/certificados')->name('certificados.')->group(function() {
            // Rota para listar certificados
            Route::get('/', [ProfessorCertificadoController::class, 'certificados'])->name('index');
            Route::put('/aprovar/{id}', [ProfessorCertificadoController::class, 'aprovar'])->name('aprovar');
            Route::put('/rejeitar/{id}', [ProfessorCertificadoController::class, 'rejeitar'])->name('reprovar');
        });
    });
});

