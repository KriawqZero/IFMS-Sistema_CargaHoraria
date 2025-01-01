<?php

use App\Http\Controllers\AlunoController;
use App\Http\Middleware\AutenticarUsuario;
use App\Http\Middleware\JWTTokenMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [AlunoController::class, 'showLoginForm'])
    ->name('aluno.login')
    ->middleware(JWTTokenMiddleware::class);

Route::post('/', [AlunoController::class, 'processLogin'])
    ->name('aluno.login.post');

Route::get('aluno', [AlunoController::class, 'index'])
    ->name('aluno.index')
    ->middleware(AutenticarUsuario::class);


