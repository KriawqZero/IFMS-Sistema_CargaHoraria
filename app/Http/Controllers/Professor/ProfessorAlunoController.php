<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Http\Services\Professor\AlunoService;
use App\Http\Services\Professor\TurmaService;
use Illuminate\Http\Request;

class ProfessorAlunoController extends Controller {
    public function __construct(
        private AlunoService $alunoService,
        private TurmaService $turmaService
    ) {}

    /**
     * Lista alunos com filtros
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request) {
        $filters = [
            'turma' => $request->input('turma', 'todas'),
            'aluno_id' => $request->input('id'),
            'pesquisa' => $request->input('pesquisa'),
        ];

        return view('professor/alunos', [
            'titulo' => 'Alunos',
            'alunos' => $this->alunoService->getAlunosFiltrados(
                auth('professor')->user(),
                $filters
            ),
            'turmas' => $this->turmaService->getTurmasProfessor(auth('professor')->id()),
            'filters' => $filters
        ]);
    }
}
