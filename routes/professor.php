<?php

use App\Http\Controllers\Professor\ProfessorController;
use App\Http\Controllers\Professor\ProfessorCertificadoController;
use App\Http\Middleware\VerifyAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Professor\CsvController;
use App\Http\Middleware\VerifyPermission;

// Grupo de rotas do professor (nomes prefixados com 'professor.')
Route::name('professor.')->group(function() {
    // Rota de processamento do login do professor
    Route::post('professor', [ProfessorController::class, 'processLogin'])
        ->name('login.post');

    // Rota de logout do professor
    Route::get('professor/logout', [ProfessorController::class, 'logout'])
        ->name('logout');

    // Grupo de rotas protegidas por autenticação
    Route::middleware([VerifyAuth::class . ':professor'])->group(function() {
        // Rota de formulario de login do professor
        Route::get('professor', [ProfessorController::class, 'showLoginForm'])
        ->name('login');

        // Rota de dashboard do professor
        Route::get('professor/dashboard', [ProfessorController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('professor/alunos', [ProfessorController::class, 'listarAlunos'])
            ->name('alunos.index');

        Route::get('/coord/cadastrar-alunos', [CsvController::class, 'create'])->name('create.alunos');

        Route::middleware([VerifyPermission::class . ':coordenador'])->group(function() {
            Route::post('/coord/cadastrar-alunos', [CsvController::class, 'store'])->name('create.alunos.post');
        });

        // Rotas de certificados do professor
        Route::prefix('professor/certificados')->name('certificados.')->group(function() {
            // Rota para listar certificados
            Route::get('/', [ProfessorCertificadoController::class, 'index'])->name('index');
            Route::patch('/patch/{id}', [ProfessorCertificadoController::class, 'patch'])->name('patch');
        });
    });
});
