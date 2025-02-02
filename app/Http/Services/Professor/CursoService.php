<?php

namespace App\Http\Services\Professor;

use App\Models\Curso;
use Illuminate\Support\Collection;

class CursoService {
    public function getAllCursos(): Collection {
        return Curso::all();
    }

    public function getCursoPorId($id) {
        return Curso::find($id);
    }

    public function storeCurso($data): bool {
        try {
            Curso::create($data);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateCurso($id, $data): bool {
        try {
            Curso::find($id)->update($data);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function deleteCurso($id): bool {
        try {
            Curso::destroy($id);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
