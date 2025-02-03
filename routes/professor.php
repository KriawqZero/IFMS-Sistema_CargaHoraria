<?php

use App\Http\Controllers\Professor\{ ProfessorController, ProfessorCursoController, ProfessorCertificadoController, ProfessorAlunoController, CsvController, ProfessorProfessorController}; use App\Http\Middleware\VerifyPermission;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VerifyAuth;
use App\Http\Middleware\VerifyPrimeiroAcesso;

// Grupo de rotas do professor (nomes prefixados com 'professor.')
Route::name('professor.')->group(function() {
    // Rota de processamento do login do professor
    Route::post('professor', [ProfessorController::class, 'processLogin'])
        ->name('login.post');

    // Rota de logout do professor
    Route::get('professor/logout', [ProfessorController::class, 'logout'])
        ->name('logout');

    Route::middleware([VerifyAuth::class . ':professor'])->group(function() {
        // Rota de troca de senha do professor
        Route::get('professor/atualizar-senha', [ProfessorController::class, 'trocarSenhaForm'])
            ->name('trocarSenha');
        // Rota de atualização de senha do professor
        Route::post('professor/atualizar-senha', [ProfessorController::class, 'trocarSenha'])
            ->name('trocarSenha.post');
    });

    // Grupo de rotas protegidas por autenticação
    Route::middleware([VerifyAuth::class . ':professor', VerifyPrimeiroAcesso::class])->group(function() {
        // Rota de formulario de login do professor
        Route::get('login/professor', [ProfessorController::class, 'showLoginForm'])
        ->name('login');

        // Rota de dashboard do professor
        Route::get('professor', [ProfessorController::class, 'dashboard'])
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
            // Rota para validar/invalidar um certificado
            Route::patch('/patch/{id}', [ProfessorCertificadoController::class, 'patch'])
                ->middleware([VerifyPermission::class . ':professor'])
                ->name('patch');
        });

        Route::prefix('professor/professores')->name('professores.')->group(function () {
            // Rota para listar professores
            Route::get('/', [ProfessorProfessorController::class, 'index'])->name('index');
            // Rota para criar um professor
            Route::get('/criar', [ProfessorProfessorController::class, 'create'])->name('create');
            // Rota para editar um professor
            Route::get('/edit/{id}', [ProfessorProfessorController::class, 'edit'])->name('edit');

            Route::middleware([VerifyPermission::class . ':coordenador'])->group(function() {
                // Rota para armazenar um professor
                Route::post('/criar1', [ProfessorProfessorController::class, 'store'])->name('store');
                // Rota para atualizar um professor
                Route::put('/edit/{id}', [ProfessorProfessorController::class, 'put'])->name('update');
                // Rota para deletar um professor
                Route::delete('/{id}', [ProfessorProfessorController::class, 'destroy'])->name('destroy');
            });
        });

        // Rotas de cursos do professor
        Route::prefix('professor/cursos')->name('cursos.')->group(function() {
            // Rota para listar cursos
            Route::get('/', [ProfessorCursoController::class, 'index'])->name('index');
            // Rota para criar um curso
            Route::get('/criar', [ProfessorCursoController::class, 'create'])->name('create');
            // Rota para editar um curso
            Route::get('/edit/{id}', [ProfessorCursoController::class, 'edit'])->name('edit');

            // Grupo de rotas protegidas por permissão de coordenador
            Route::middleware([VerifyPermission::class . ':coordenador'])->group(function() {
                // Rota para armazenar um curso
                Route::post('/', [ProfessorCursoController::class, 'store'])->name('store');
                // Rota para atualizar um curso
                Route::put('/edit/{id}', [ProfessorCursoController::class, 'put'])->name('update');
                // Rota para deletar um curso
                Route::delete('/{id}', [ProfessorCursoController::class, 'destroy'])->name('destroy');
            });
        });
    });
});

