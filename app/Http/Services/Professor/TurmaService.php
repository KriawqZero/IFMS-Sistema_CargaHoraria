<?php

namespace App\Http\Services\Professor;

use App\Models\Professor;
use App\Models\Turma;
use Illuminate\Support\Collection;

class TurmaService {
    /**
     * Obtém turmas do professor
     *
     * @param  Professor  $professor
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTurmasProfessor(Professor $professor): Collection {
        if ($professor->cargo !== 'professor') {
            return Turma::all();
        }
        return $professor->turmas;
    }

    /**
     * Obtém turma por código
     *
     * @param  string  $codigo
     * @return Turma|null
     */
    public function getTurmaPorCodigo(string $codigo): ?Turma {
        return Turma::where('codigo', $codigo)->first();
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
     * Obtém turma por id
     *
     * @param  int  $id
     * @return Turma
     */
    public function getTurmaPorId(int $id): Turma {
        return Turma::findOrFail($id);
    }

    /**
     * Obtém todas as turmas com relacionamentos
     *
     * @return Collection
     */
    public function getAllTurmasComRelacionamentos(): Collection {
        return Turma::with(['curso', 'professor'])->get();
    }

    /**
     * Armazena turma
     *
     * @param  array  $input
     * @return bool
     */
    public function storeTurma(array $input): bool {
        try {
            Turma::create($input);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Atualiza turma
     *
     * @param  int  $id
     * @param  array  $input
     * @return bool
     */
    public function updateTurma(int $id, array $input): bool {
        try {
            Turma::findOrFail($id)->update($input);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Deleta turma
     *
     * @param  int  $id
     * @return bool
     */
    public function deleteTurma(int $id): bool {
        try {
            Turma::findOrFail($id)->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
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
