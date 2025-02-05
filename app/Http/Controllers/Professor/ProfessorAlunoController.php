<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Professor\Alunos\StoreAlunoRequest;
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

        return view('professor/alunos/index', [
            'titulo' => 'Alunos',
            'alunos' => $this->alunoService->getAlunosFiltrados(
                auth('professor')->user(),
                $filters
            ),
            'turmas' => $this->turmaService->getTurmasProfessor(auth('professor')->user()),
            'filters' => $filters
        ]);
    }

    public function show($id) {
        $aluno = $this->alunoService->getAluno($id);

        return view('professor/alunos/show', [
            'titulo' => 'Aluno',
            'aluno' => $aluno,
            'turmas' => $this->turmaService->getTurmasProfessor(auth('professor')->user())
        ]);
    }

    public function create() {
        return view('professor/alunos/create', [
            'titulo' => 'Cadastrar Aluno',
            'turmas' => $this->turmaService->getTurmasProfessor(auth('professor')->user())
        ]);
    }

    public function store(StoreAlunoRequest $request) {
        $input = $request->validated();

        if($this->alunoService->store(
            $input['nome'],
            $input['cpf'],
            $input['data_nascimento'],
            $input['id_turma'] ?? null
        )) return redirect()->route('professor.alunos.index')
            ->with('success', 'Aluno cadastrado com sucesso!');

        return redirect()->back()->withErrors('Erro ao cadastrar aluno!');
    }

    public function edit($id) {
        $aluno = $this->alunoService->getAluno($id);

        return view('professor/alunos/edit', [
            'titulo' => 'Editar Aluno',
            'aluno' => $aluno,
            'turmas' => $this->turmaService->getTurmasProfessor(auth('professor')->user())
        ]);

    }
}
