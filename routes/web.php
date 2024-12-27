<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\ProfessorController;
use App\Http\Middleware\AutenticarUsuario;
use App\Http\Middleware\JWTTokenMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [AlunoController::class, 'showLoginForm'])
    ->name('aluno.login')
    ->middleware(JWTTokenMiddleware::class);

Route::post('/', [AlunoController::class, 'processLogin'])
    ->name('aluno.login.post');

Route::middleware(AutenticarUsuario::class)->group(function() {
    Route::get('professor', [ProfessorController::class, 'showLoginForm'])
        ->name('professor.login');

    Route::get('aluno', [AlunoController::class, 'index'])
        ->name('aluno.index');
});



