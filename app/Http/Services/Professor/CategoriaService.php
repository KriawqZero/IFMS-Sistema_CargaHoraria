<?php

namespace App\Http\Services\Professor;

use App\Models\Categoria;

class CategoriaService {
    public function getAllCategorias() {
        return Categoria::all();
    }
}
