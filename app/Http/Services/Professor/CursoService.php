<?php

namespace App\Http\Services\Professor;

use App\Models\Curso;
use Illuminate\Support\Collection;

class CursoService {
    /**
     * Retorna todos os cursos
     *
     * @return Collection
     */
    public function getAllCursos(): Collection {
        return Curso::all();
    }

    /**
     * Retorna um curso por id
     *
     * @param int $id
     * @return Curso
     */
    public function getCursoPorId($id) {
        return Curso::find($id);
    }

    /**
     * Cria um curso
     *
     * @param array $data
     * @return bool
     */
    public function storeCurso($data): bool {
        try {
            Curso::create($data);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Atualiza um curso
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateCurso($id, $data): bool {
        try {
            Curso::find($id)->update($data);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Deleta um curso
     *
     * @param int $id
     * @return bool
     */
    public function deleteCurso($id): bool {
        try {
            Curso::destroy($id);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
