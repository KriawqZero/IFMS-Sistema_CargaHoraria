<?php

use App\Http\Controllers\AlunoController;
use App\Http\Middleware\AutenticarUsuario;
use App\Http\Middleware\JWTTokenMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('login', [AlunoController::class, 'loginForm'])
    ->name('login')
    ->middleware(JWTTokenMiddleware::class);

Route::post('login', [AlunoController::class, 'login']);

Route::get('index', [AlunoController::class, 'index'])
    ->name('index')
    ->middleware(AutenticarUsuario::class);

Route::get('/', function () {
    return view('Enviar/enviarCertificado');
});

