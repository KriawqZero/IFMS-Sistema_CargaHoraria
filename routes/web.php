<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PerfilController;
use App\Http\Middleware\VerifyAuth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::name('perfil.')->prefix('perfil')->group(function() {
    Route::middleware([VerifyAuth::class . ':all'])->group(function() {
        Route::get('/', [PerfilController::class, 'perfil'])->name('index');
        Route::patch('/update', [PerfilController::class, 'perfilUpdate'])->name('update');

    });
});

Route::get('/notas-de-atualizacao', function() {
    try {
        $notas = json_decode(Storage::disk('public')->get('updates.json'), true);
    } catch (Exception $e) {
        $notas = [];
    }
    return view('sobre.notas-de-atualizacao', [
        'titulo' => 'Notas de Atualização',
        'notas' => $notas,
    ]);
})->middleware([VerifyAuth::class . ':all'])->name('notas-de-atualizacao');

Route::get('/ajuda', function() {
    return view('ajuda.index', [
        'titulo' => 'Ajuda - Login',
    ]);
})->name('ajuda');

Route::name('reports.')->prefix('reports')->group(function() {
    Route::middleware([VerifyAuth::class . ':all'])->group(function() {
        Route::get('/', [FeedbackController::class, 'index'])->name('index');
        Route::post('/', [FeedbackController::class, 'store'])->name('store');
    });
});

// Carregar rotas específicas
require base_path('routes/aluno.php');
require base_path('routes/professor.php');

// Rota pública para obter a versão atual
Route::get('/api/version', function () {
    return response()->json([
        'version' => App\Helpers\VersionHelper::getLatestVersion()
    ]);
});
