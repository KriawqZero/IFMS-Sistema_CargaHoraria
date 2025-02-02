<?php

use App\Http\Controllers\Professor\{ ProfessorController, ProfessorCursoController, ProfessorCertificadoController, ProfessorAlunoController, CsvController }; use App\Http\Middleware\VerifyPermission;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VerifyAuth;

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

        Route::get('professor/alunos', [ProfessorAlunoController::class, 'listarAlunos'])
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

        // Rotas de cursos do professor
        Route::prefix('professor/cursos')->name('cursos.')->group(function() {
            // Rota para listar cursos
            Route::get('/', [ProfessorCursoController::class, 'index'])->name('index');
            // Rota para criar um curso
            Route::get('/criar', [ProfessorCursoController::class, 'create'])->name('create');
            // Rota para editar um curso
            Route::get('/{id}/edit', [ProfessorCursoController::class, 'edit'])->name('edit');

            // Grupo de rotas protegidas por permissão de coordenador
            Route::middleware([VerifyPermission::class . ':coordenador'])->group(function() {
                // Rota para armazenar um curso
                Route::post('/', [ProfessorCursoController::class, 'store'])->name('store');
                // Rota para atualizar um curso
                Route::put('/{id}', [ProfessorCursoController::class, 'put'])->name('update');
                // Rota para deletar um curso
                Route::delete('/{id}', [ProfessorCursoController::class, 'destroy'])->name('destroy');
            });
        });
    });
});

