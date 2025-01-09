<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\ProfessorController;
use App\Http\Middleware\VerifyAuth;
use App\Http\Middleware\VerifyJWT;
use Illuminate\Support\Facades\Route;

// Grupo de rotas do aluno (nomes prefixados com 'aluno.')
Route::name('aluno.')->group(function() {
    Route::middleware(VerifyJWT::class)->group(function() {
        // Rota de processamento do login do aluno
        Route::post('/', [AlunoController::class, 'processLogin'])
            ->name('login.post');

        // Rota de logout do aluno
        Route::get('aluno/logout', [AlunoController::class, 'logout'])
            ->name('logout');

        Route::get('aluno/sobre', [AlunoController::class, 'sobre'])
            ->name('sobre');
    });

    // Grupo de rotas protegidas por autenticação
    Route::middleware([VerifyAuth::class . ':aluno'])->group(function() {
        // Rota de formulario de login do aluno
        Route::get('/', [AlunoController::class, 'showLoginForm'])
            ->name('login');

        // Rota de dashboard do aluno
        Route::get('aluno', [AlunoController::class, 'dashboard'])
            ->name('dashboard');

        // Rota de formulario de envio de certificado
        Route::get('aluno/enviar-certificado', [AlunoController::class, 'showEnviarCertificadoForm'])
            ->name('enviar-certificado');

        // Rota de processamento do envio de certificado
        Route::post('aluno/enviar-certificado', [AlunoController::class, 'processEnviarCertificado'])
            ->name('enviar-certificado.post');

        // Rota de detalhamento de certificados
        Route::get('aluno/detalhamento', [AlunoController::class, 'detalhamento'])
            ->name('detalhamento');
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
    Route::middleware(VerifyAuth::class)->group(function() {
        // Rota de dashboard do professor
        Route::get('professor/dashboard', [ProfessorController::class, 'dashboard'])
            ->name('dashboard');
    });
});




