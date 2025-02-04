<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Professor\Professores\CriarProfessorRequest;
use App\Http\Services\Professor\{ProfessorCRUDService, TurmaService};
use App\Models\{Professor, Turma};
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

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

        // Gera a senha automática
        $partesNome = explode(' ', $validated['nome']);
        $primeiroNome = Str::lower(Str::ascii($partesNome[0])); // Remove acentos e coloca em minúsculo
        $ultimoNome = Str::lower(Str::ascii(end($partesNome))); // Pega o último nome
        $senhaTexto = $primeiroNome . '.' . $ultimoNome;

        // Cria o professor
        $professor = $this->professorService->criarProfessor([
            'nome' => $validated['nome'],
            'senha' => bcrypt($senhaTexto),
            'primeiro_acesso' => true,
            'cargo' => $validated['cargo'],
        ]);

        // Atualiza as turmas selecionadas
        if (!empty($validated['turmas'])) {
            $this->turmaService->atualizarProfessorTurmas($professor->id, $validated['turmas']);
        }

        return redirect()
            ->route('professor.professores.index')
            ->with('success', 'Professor cadastrado com sucesso! Senha inicial: ' . $senhaTexto);
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

    public function patch(Request $request, $id) {
        $input= $request->validate([
            'nome' => 'nullable|istring|max:255',
            'cargo' => 'nullable|in:professor,coordenador,admin',
            'turmas' => 'nullable|array|max:3',
            'turmas.*' => [
                'required',
                'integer',
                Rule::exists('turmas', 'id')->whereNull('professor_id'),
            ],
        ]);

        $this->professorService->atualizarProfessor($id, [
            'nome' => $input['nome'],
            'cargo' => $input['cargo'],
        ]);

        return redirect()->route('professor.professores.index');
    }

    public function destroy($id) {
        $this->professorService->excluirProfessor($id);
        return redirect()->route('professor.professores.index');
    }
}
