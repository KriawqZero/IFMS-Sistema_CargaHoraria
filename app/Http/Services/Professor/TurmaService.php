<?php

namespace App\Http\Services\Professor;

use App\Models\Turma;
use Illuminate\Support\Collection;

class TurmaService {
    /**
     * Obtém turmas do professor
     *
     * @param  Professor  $professor
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTurmasProfessor(int $professor_id): Collection {
        return Turma::where('professor_id', $professor_id)->get();
    }

    /**
     * Obtém todas as turmas
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllTurmas(): Collection {
        return Turma::all();
    }

    /**
     * Atualiza as turmas do professor
     *
     * @param  int  $professor_id
     * @param  array  $turmasIds
     * @return void
     */
    public function atualizarProfessorTurmas(int $professor_id, array $turmasIds): bool {
        try {
            // Adiciona o novo professor às turmas selecionadas
            Turma::whereIn('id', $turmasIds)->update(['professor_id' => $professor_id]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Desvincula o professor das turmas selecionadas
     *
     * @param  array  $turmasIds
     * @return bool
     */
    public function desvincularProfessorTurmas(int $professor_id): bool {
        try {
            // Remove o professor das turmas
            Turma::where('professor_id', $professor_id)->update(['professor_id' => null]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
