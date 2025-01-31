<?php
namespace App\Http\Services\Professor;

use App\Models\Professor;

class AlunoService {
    /**
     * Obtém turmas do professor
     *
     * @param  Professor  $professor
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTurmasProfessor(Professor $professor) {
        return $professor->turmas()->withCount('alunos')->get();
    }

    /**
     * Obtém alunos filtrados
     *
     * @param  Professor  $professor
     * @param  array  $filters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAlunosFiltrados(Professor $professor, array $filters) {
        $query = $professor->alunos()
            ->with('turma')
            ->when($filters['turma'] !== 'todas', function($q) use ($filters) {
                $q->whereHas('turma', function($q) use ($filters) {
                    $q->where('codigo', $filters['turma']);
                });
            })
            ->when($filters['aluno_id'], function($q, $id) {
                $q->where('id', $id);
            });

        return $query->get();
    }
}
