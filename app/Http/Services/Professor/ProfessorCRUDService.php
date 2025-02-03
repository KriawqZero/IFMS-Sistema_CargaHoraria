<?php
namespace App\Http\Services\Professor;

use App\Models\Professor;

class ProfessorCRUDService {
    public function listarProfessores() {
        return Professor::latest()->get();
    }

    public function encontrarProfessor($id) {
        return Professor::findOrFail($id);
    }

    public function criarProfessor(array $dados) {
        return Professor::create($dados);
    }

    public function atualizarProfessor($id, array $dados) {
        $professor = Professor::findOrFail($id);
        $professor->update($dados);
        return $professor;
    }

    public function excluirProfessor($id) {
        $professor = Professor::findOrFail($id);
        return $professor->delete();
    }
}
