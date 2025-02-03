<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Http\Services\Professor\ProfessorCRUDService;
use App\Models\Professor;
use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProfessorProfessorController extends Controller {
    public function __construct(
         private ProfessorCRUDService $professorService
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

    public function store(Request $request) {
        // Validação dos dados
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cargo' => 'required|in:professor,coordenador,admin',
            'turmas' => 'nullable|array|max:3',
            'turmas.*' => [
                'required',
                'integer',
                Rule::exists('turmas', 'id')->whereNull('professor_id'),
            ],
        ]);

        // Gera a senha automática
        $partesNome = explode(' ', $validated['nome']);
        $primeiroNome = Str::lower(Str::ascii($partesNome[0])); // Remove acentos e coloca em minúsculo
        $ultimoNome = Str::lower(Str::ascii(end($partesNome))); // Pega o último nome
        $senhaTexto = $primeiroNome . '.' . $ultimoNome;

        // Cria o professor
        $professor = Professor::create([
            'nome' => $validated['nome'],
            'senha' => bcrypt($senhaTexto),
            'primeiro_acesso' => true,
            'cargo' => $validated['cargo'],
        ]);

        // Atualiza as turmas selecionadas
        if (!empty($validated['turmas'])) {
            Turma::whereIn('id', $validated['turmas'])
                ->update(['professor_id' => $professor->id]);
        }

        return redirect()
            ->route('professor.professores.index')
            ->with('success', 'Professor cadastrado com sucesso! Senha inicial: ' . $senhaTexto);
    }

    public function edit($id) {
        $professor = $this->professorService->encontrarProfessor($id);
        $turmas = Turma::all();

        return view('professor.professores.edit', [
            'titulo' => 'Editar Professor',
            'professor' => $professor,
            'turmas' => $turmas
        ]);
    }

    public function put(Request $request, $id) {
        $validados = $request->validate([
            'name' => 'sometimes|string|max:255',
            'degree' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:teachers,email,' . $id,
            'birthdate' => 'sometimes|date',
        ]);

        $this->professorService->atualizarProfessor($id, $validados);
        return redirect()->route('professor.professores.index');
    }

    public function destroy($id) {
        $this->professorService->excluirProfessor($id);
        return redirect()->route('professor.professores.index');
    }
}
