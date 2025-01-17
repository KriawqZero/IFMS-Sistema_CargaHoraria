<?php

use App\Http\Controllers\Professor\ProfessorController;
use App\Http\Controllers\Professor\ProfessorCertificadoController;
use App\Http\Middleware\VerifyAuth;
use Illuminate\Support\Facades\Route;

// Grupo de rotas do professor (nomes prefixados com 'professor.')
Route::name('professor.')->group(function() {
    // Rota de processamento do login do professor
    Route::post('professor', [ProfessorController::class, 'processLogin'])
        ->name('login.post');

    // Grupo de rotas protegidas por autenticação
    Route::middleware([VerifyAuth::class . ':professor'])->group(function() {
        // Rota de formulario de login do professor
        Route::get('professor', [ProfessorController::class, 'showLoginForm'])
        ->name('login');

        // Rota de dashboard do professor
        Route::get('professor/dashboard', [ProfessorController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('professor/alunos', [ProfessorController::class, 'listarAlunos'])
            ->name('alunos');

        // Rotas de certificados do professor
        Route::prefix('professor/certificados')->name('certificados.')->group(function() {
            // Rota para listar certificados
            Route::get('/', [ProfessorCertificadoController::class, 'index'])->name('index');
            Route::put('/aprovar/{id}', [ProfessorCertificadoController::class, 'aprovar'])->name('aprovar');
            Route::put('/rejeitar/{id}', [ProfessorCertificadoController::class, 'rejeitar'])->name('reprovar');
        });
    });
});
