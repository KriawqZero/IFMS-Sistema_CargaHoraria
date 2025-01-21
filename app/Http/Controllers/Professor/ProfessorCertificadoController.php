<?php

namespace App\Http\Controllers\Professor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Certificado;

class ProfessorCertificadoController extends Controller {

    public function index(Request $request) {
        /** @var \App\Models\Professor $professor */
        $professor = auth('professor')->user(); // Obtenha o professor autenticado

        // Obtenha as turmas do professor
        $turmas = $professor->turmas()->get();

        // Parâmetros de filtro e pesquisa
        $pesquisa = $request->input('pesquisa', null);
        $turmaId = $request->input('turma', 'todas');
        $perPage = $request->input('per_page', 10);

        $certificados = Certificado::query()
            ->whereHas('aluno', function ($query) use ($turmas, $pesquisa, $turmaId) {
                $query->whereIn('turma_id', $turmas->pluck('id')) // Filtra pelas turmas do professor
                ->when($pesquisa, function ($query, $pesquisa) {
                    $query->where('nome', 'like', '%' . $pesquisa . '%'); // Adiciona a pesquisa por nome do aluno, se fornecida
                })
                    ->when($turmaId && $turmaId !== 'todas', function ($query) use ($turmaId) {
                        $query->where('turma_id', $turmaId); // Filtra por turma, se fornecida
                    });
            })
            ->with(['aluno.turma']) // Carrega as relações aluno e turma
            ->latest() // Ordena por data de criação
            ->paginate($perPage)
            ->appends($request->all()); // Mantém os parâmetros na URL das páginas

        return view('professor.certificados', [
            'titulo' => 'Certificados',
            'certificados' => $certificados,
            'turmas' => $turmas,
            'pesquisa' => $pesquisa,
            'turma' => $turmaId,
            'per_page' => $perPage,
        ]);
    }
    public function validar() {

    }

    public function invalidar() {

    }
}
