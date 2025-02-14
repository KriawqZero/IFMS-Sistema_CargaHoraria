<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Professor\Alunos\PatchAlunoRequest;
use App\Http\Requests\Professor\Alunos\StoreAlunoRequest;
use App\Http\Services\Professor\AlunoService;
use App\Http\Services\Professor\TurmaService;
use App\Http\Services\Aluno\CertificadoExportService;
use Illuminate\Http\Request;

class ProfessorAlunoController extends Controller {
    public function __construct(
        private CertificadoExportService $exportService,
        private AlunoService $alunoService,
        private TurmaService $turmaService
    ) {}

    public function exportarCertificadosAluno($id) {
        $aluno = $this->alunoService->getAluno($id);
        return $this->exportService->gerarPlanilha($aluno);
    }

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

    public function destroy($id) {
        if($this->alunoService->delete($id)) return redirect()->route('professor.alunos.index')
            ->with('success', 'Aluno deletado com sucesso!');

        return redirect()->back()->withErrors('Erro ao deletar aluno!');
    }

    public function edit($id) {
        $aluno = $this->alunoService->getAluno($id);

        return view('professor/alunos/edit', [
            'titulo' => 'Editar Aluno',
            'aluno' => $aluno,
            'turmas' => $this->turmaService->getTurmasProfessor(auth('professor')->user())
        ]);
    }

    public function concluir($id) {
        $aluno = $this->alunoService->getAluno($id);
        if(!$aluno->estaAprovado())
            return redirect()->back()->withErrors('Aluno ainda não cumpriu a carga horária minima necessária para conclusão.');

        if($this->alunoService->update(
            $id, null, null, null, true, $aluno->turma->id
        )) return redirect()->route('professor.alunos.show', $id)
            ->with('success', 'Aluno concluído com sucesso!');

        return redirect()->back()->withErrors('Erro ao concluir aluno!');
    }

    public function patch(PatchAlunoRequest $request, $id) {
        $input = $request->validated();

        if($this->alunoService->update(
            $id,
            $input['nome'] ?? null,
            $input['cpf'] ?? null,
            $input['data_nascimento'] ?? null,
            null,
            $input['id_turma'] ?? null
        )) return redirect()->route('professor.alunos.index')
            ->with('success', 'Aluno atualizado com sucesso!');

        return redirect()->back()->withErrors('Erro ao atualizar aluno!');
    }
}
