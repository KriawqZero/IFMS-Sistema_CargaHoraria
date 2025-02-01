<?php

namespace App\Http\Services\Professor;

use App\Models\Professor;
use App\Models\Turma;

class TurmaService {
    public function getTurmas(Professor $professor): \Illuminate\Database\Eloquent\Collection {
        return $professor->turmas;
    }


}
