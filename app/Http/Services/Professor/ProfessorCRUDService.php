<?php
namespace App\Http\Services\Professor;

use App\Models\Professor;

class ProfessorCRUDService {
    /**
     * Lista todos os professores
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function listarProfessores() {
        return Professor::latest()->get();
    }

    /**
     * Encontra um professor
     *
     * @param  int  $id
     * @return Professor
     */
    public function encontrarProfessor($id) {
        return Professor::findOrFail($id);
    }

    /**
     * Cria um professor
     *
     * @param  array  $dados
     * @return Professor
     */
    public function criarProfessor(array $dados) {
        return Professor::create($dados);
    }

    /**
     * Atualiza um professor
     *
     * @param  int  $id
     * @param  array  $dados
     * @return Professor
     */
    public function atualizarProfessor($id, array $dados) {
        $professor = Professor::findOrFail($id);
        $professor->update($dados);

        return $professor;
    }

    /**
     * Exclui um professor
     *
     * @param  int  $id
     * @return bool
     */
    public function excluirProfessor($id) {
        $professor = Professor::findOrFail($id);
        return $professor->delete();
    }
}
