<?php

namespace App\Http\Controllers\Professor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfessorCertificadoController extends Controller {
    public function index() {
        $professor = auth('professor')->user(); // Obtenha o professor autenticado

        return view('professor.certificados', [
            'titulo' => 'Certificados',
            'certificados' => $professor->certificados,
        ]);
    }

    public function aprovar() {

    }

    public function rejeitar() {

    }
}
