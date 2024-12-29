<?php

use App\Http\Controllers\AlunoController;
use App\Http\Middleware\AutenticarUsuario;
use App\Http\Middleware\JWTTokenMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [AlunoController::class, 'loginForm'])
    ->name('login')
    ->middleware(JWTTokenMiddleware::class);

Route::post('/', [AlunoController::class, 'login']);

Route::get('aluno', [AlunoController::class, 'redirectToAlunoIndex'])
    ->name('alunoIndex')
    ->middleware(AutenticarUsuario::class);


