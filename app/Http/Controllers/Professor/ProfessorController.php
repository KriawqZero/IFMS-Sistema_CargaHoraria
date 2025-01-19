<?php

namespace App\Http\Controllers\Professor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Professor;
use Illuminate\Support\Facades\Hash;

class ProfessorController extends Controller {
    public function showLoginForm() {
        return view('professor/login', [
            'titulo' => 'Login Professor',
        ]);
    }

    public function listarAlunos(Request $request) {
        $professor = auth('professor')->user();

        // Recupera todas as turmas associadas ao professor e os alunos relacionados
        $turmas = $professor->turmas;
        $alunos = $turmas->pluck('alunos')->flatten();

        // Se houver um filtro de turma
        if ($request->has('turma') && $request->turma != 'todas') {
            $turmaSelecionada = $request->turma;
            $alunos = $alunos->filter(function($aluno) use ($turmaSelecionada) {
                return $aluno->turma->codigo == $turmaSelecionada;
            });
        }

        return view('professor/alunos', [
            'titulo' => 'Alunos',
            'professor' => $professor,
            'alunos' => $alunos,
            'turmas' => $turmas,
        ]);
    }

    public function dashboard() {
        $professor = auth('professor')->user();
        $turmas = $professor->turmas;

        return view('professor/index', [
            'titulo' => 'Professor',
            'professor' => $professor,
            'turmas' => $turmas,
        ]);
    }

    public function validarCertificados() {
        $professor = auth('professor')->user();

        return view('professor/validar_certificados', [
            'titulo' => "Validar Certificados",
            'professor' => $professor,
        ]);
    }

    public function processLogin(Request $request) {
        auth('aluno')->logout();

        // Valida os campos de entrada.
        $credentials = $request->validate([
            'login' => 'required|string',
            'senha' => 'required|string',
        ]);

        // Dividir o login em partes para correspondência.
        $loginParts = explode('.', strtolower($credentials['login']));
        if (count($loginParts) !== 2) {
            return redirect()->route('professor.login')
                ->withErrors(['login' => 'Formato de login inválido. Use {primeironome}.{ultimonome}.']);
        }

        [$primeiroNome, $ultimoNome] = $loginParts;

        // Buscar o professor onde o primeiro e o último nome correspondem ao login fornecido.
        $professor = Professor::whereRaw('LOWER(SUBSTRING_INDEX(nome, " ", 1)) = ?', [$primeiroNome])
            ->whereRaw('LOWER(SUBSTRING_INDEX(nome, " ", -1)) = ?', [$ultimoNome])
            ->first();

        if (!$professor || !Hash::check($request->senha, $professor->senha)) {
            return redirect()->route('professor.login')
                ->withErrors(['login' => 'Credenciais inválidas.']);
        }

        // Autenticar o professor.
        auth('professor')->login($professor);

        // Redirecionar para o dashboard em caso de sucesso.
        return redirect()->route('professor.dashboard');
    }

}
