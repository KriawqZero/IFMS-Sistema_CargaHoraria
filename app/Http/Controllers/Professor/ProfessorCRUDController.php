<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Professor\Professores\CriarProfessorRequest;
use App\Http\Requests\Professor\Professores\EditarProfessorRequest;
use App\Http\Services\Professor\{ProfessorCRUDService, TurmaService};
use App\Models\Turma;

class ProfessorCRUDController extends Controller {
    public function __construct(
        private ProfessorCRUDService $professorService,
        private TurmaService $turmaService
    ) { }

    public function index() {
        $professores = $this->professorService->listarProfessores();

        return view('professor.professores.index', [
            'titulo' => 'Professores',
            'professores' => $professores
        ]);
    }

    public function create() {
        $turmas = Turma::with('curso')->get();

        return view('professor.professores.create', [
            'titulo' => 'Criar Professor',
            'turmas' => $turmas
        ]);
    }

    public function store(CriarProfessorRequest $request) {
        $validated = $request->validated();

        /** @var Professor $professor */
        $professor = auth('professor')->user();

        if ($professor->cargoMenorQue($validated['cargo'])) {
            return redirect()
                ->route('professor.professores.index')
                ->withErrors('Você não tem permissao pra realizar essa ação..');
        }

        // Cria o professor
        $retorno = $this->professorService->criarProfessor(
            $validated['nome'],
            $validated['cargo']
        );

        // Atualiza as turmas selecionadas
        if (!empty($validated['turmas'])) {
            $this->turmaService->atualizarProfessorTurmas($retorno['professor_id'], $validated['turmas']);
        }

        return redirect()
            ->route('professor.professores.index')
            ->with('success', 'Professor cadastrado com sucesso! Senha inicial: ' . $retorno['senhaTexto']);
    }

    public function edit($id) {
        $professor = $this->professorService->encontrarProfessor($id);
        $turmas = $this->turmaService->getAllTurmas();

        return view('professor.professores.edit', [
            'titulo' => 'Editar Professor',
            'professor' => $professor,
            'turmas' => $turmas
        ]);
    }

    public function patch(EditarProfessorRequest $request, $id) {
        $input = $request->validated();

        $this->professorService->atualizarProfessor($id, [
            'nome' => $input['nome'],
            'cargo' => $input['cargo'],
        ]);

        $this->turmaService->desvincularProfessorTurmas($id);
        if (!empty($input['turmas'])) {
            $this->turmaService->atualizarProfessorTurmas($id, $input['turmas']);
        }

        return redirect()->back()->with('success', 'Professor atualizado com sucesso!');
    }

    public function destroy($id) {
        $this->professorService->excluirProfessor($id);
        return redirect()->route('professor.professores.index');
    }
}
