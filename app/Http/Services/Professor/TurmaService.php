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
}
