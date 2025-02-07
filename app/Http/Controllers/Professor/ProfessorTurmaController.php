<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Http\Services\Professor\{TurmaService, CursoService, ProfessorCRUDService};
use Illuminate\Http\Request;

class ProfessorTurmaController extends Controller {
    public function __construct(
        private TurmaService $turmaService,
        private CursoService $cursoService,
        private ProfessorCRUDService $professorService
    ) { }

    public function index() {
        $turmas = $this->turmaService->getAllTurmas();

        return view('professor.turmas.index', [
            'titulo' => 'Turmas',
            'turmas' => $turmas
        ]);
    }

    public function create() {
        return view('professor.turmas.create', [
            'titulo' => 'Criar Turma',
            'cursos' => $this->cursoService->getAllCursos(),
            'professores' => $this->professorService->getAllProfessores()
        ]);
    }

    public function store(Request $request) {
        $input = $request->all();

        if($this->turmaService->storeTurma($input))
            return redirect()->route('professor.turmas.index')->with('success', 'Turma criada com sucesso');

        return redirect()->route('professor.turmas.index')->withErrors('Erro ao criar turma. Tente novamente mais tarde');
    }

    public function edit($id) {
        return view('professor.turmas.edit', [
            'titulo' => 'Editar Turma',
            'turma' => $this->turmaService->getTurmaPorId($id),
            'cursos' => $this->cursoService->getAllCursos(),
            'professores' => $this->professorService->getAllProfessores()
        ]);
    }

    public function put(Request $request, $id) {
        $input = $request->all();

        if($this->turmaService->updateTurma($id, $input))
            return redirect()->route('professor.turmas.index')->with('success', 'Turma atualizada com sucesso');

        return redirect()->route('professor.turmas.index')->withErrors('Erro ao atualizar turma. Tente novamente mais tarde');
    }

    public function destroy($id) {
        if ($this->turmaService->deleteTurma($id))
            return redirect()->route('professor.turmas.index')->with('success', 'Turma deletada com sucesso');

        return redirect()->route('professor.turmas.index')->with('info', 'Não é possível deletar turma. Desvincule todos os alunos
            dependentes primeiro.');
    }
}
