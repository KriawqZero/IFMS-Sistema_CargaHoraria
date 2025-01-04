<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\ProfessorController;
use App\Http\Middleware\AutenticarUsuario;
use App\Http\Middleware\JWTTokenMiddleware;
use Illuminate\Support\Facades\Route;

// Grupo de rotas do aluno (nomes prefixados com 'aluno.')
Route::name('aluno.')->group(function() {
    // Rota de formulario de login do aluno
    Route::get('/', [AlunoController::class, 'showLoginForm'])
        ->name('login')
        ->middleware(JWTTokenMiddleware::class);

    // Rota de processamento do login do aluno
    Route::post('/', [AlunoController::class, 'processLogin'])
        ->name('login.post');

    // Grupo de rotas protegidas por autenticação
    Route::middleware(AutenticarUsuario::class)->group(function() {
        Route::get('dashboard', [AlunoController::class, 'dashboard'])
            ->name('dashboard');
    });
});

// Grupo de rotas do professor (nomes prefixados com 'professor.')
Route::name('professor.')->group(function() {
    Route::get('professor', [ProfessorController::class, 'showLoginForm'])
        ->name('login');

    Route::post('professor', [ProfessorController::class, 'processLogin'])
        ->name('login.post');

    Route::middleware(AutenticarUsuario::class)->group(function() {
        Route::get('professor/dashboard', [ProfessorController::class, 'dashboard'])
            ->name('dashboard');
    });
});




