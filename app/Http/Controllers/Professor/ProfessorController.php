<?php

namespace App\Http\Controllers\Professor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Professor\AlunoService;
use App\Http\Services\Professor\AuthService;

class ProfessorController extends Controller
{
    // Injeção de dependência dos serviços
    public function __construct(
        private AuthService $authService,
        private AlunoService $alunoService
    ) { }

    /**
     * Exibe o formulário de login
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm() {
        return view('professor/login', [
            'titulo' => 'Login Professor',
        ]);
    }

    /**
     * Processa o login do professor
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processLogin(Request $request) {
        try {
            // Validação básica dos campos
            $credentials = $request->validate([
                'login' => 'required|string',
                'senha' => 'required|string',
            ]);

            // Tenta autenticar usando o serviço
            $professor = $this->authService->authenticate(
                $credentials['login'],
                $credentials['senha']
            );

            // Login e redirecionamento
            auth('professor')->login($professor);
            return redirect()->route('professor.dashboard');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['login' => $e->getMessage()]);
        }
    }

    /**
     * Logout do professor
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout() {
        auth('professor')->logout();
        return redirect()->route('aluno.login');
    }

    /**
     * Dashboard principal do professor
     *
     * @return \Illuminate\View\View
     */
    public function dashboard() {
        return view('professor/index', [
            'titulo' => 'Professor',
            'professor' => auth('professor')->user(),
            'turmas' => $this->alunoService->getTurmasProfessor(auth('professor')->user())
        ]);
    }

    /**
     * Lista alunos com filtros
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function listarAlunos(Request $request) {
        try {
            $filters = [
                'turma' => $request->input('turma', 'todas'),
                'aluno_id' => $request->input('id')
            ];

            return view('professor/alunos', [
                'titulo' => 'Alunos',
                'alunos' => $this->alunoService->getAlunosFiltrados(
                    auth('professor')->user(),
                    $filters
                ),
                'turmas' => $this->alunoService->getTurmasProfessor(auth('professor')->user()),
                'filters' => $filters
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Tela de validação de certificados
     *
     * @return \Illuminate\View\View
     */
    public function validarCertificados() {
        return view('professor/certificados', [
            'titulo' => "Validar Certificados",
            'professor' => auth('professor')->user(),
        ]);
    }
}
