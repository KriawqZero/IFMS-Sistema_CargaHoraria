<?php

namespace App\Http\Controllers\Professor;

use App\Http\Services\Professor\{AuthService, TurmaService, CertificadoService};
use App\Http\Controllers\Controller;
use App\Http\Requests\Professor\LoginRequest;
use App\Http\Requests\Professor\TrocarSenhaRequest;

class ProfessorController extends Controller {
    // Injeção de dependência dos services
    public function __construct(
        private AuthService $authService,
        private TurmaService $turmaService,
        private CertificadoService $certificadoService
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
    public function processLogin(LoginRequest $request) {
        try {
            // Obtém as credenciais do formulário
            $credentials = $request->validated();

            // Tenta autenticar usando o serviço
            $professor = $this->authService->autenticar(
                $credentials['login'],
                $credentials['senha']
            );

            // Verifica se o professor é um novo usuário
            if ($professor->primeiro_acesso) {
                // Se for, redireciona para a página de troca de senha
                auth('professor')->login($professor);
                return redirect()->route('professor.trocarSenha');
            }

            // Login e redirecionamento
            auth('professor')->login($professor);
            return redirect()->route('professor.dashboard');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Exibe o formulário de troca de senha
     *
     * @return \Illuminate\View\View
     */
    public function trocarSenhaForm() {
        return view('professor.trocarSenha', [
            'titulo' => 'Trocar Senha',
        ]);
    }

    /**
     * Troca a senha do professor
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function trocarSenha(TrocarSenhaRequest $request) {
        $input = $request->validated();

        // Troca a senha do professor
        try {
            $this->authService->trocarSenha(
                auth('professor')->user(),
                $input['nova_senha']
            );
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('professor.dashboard')->with('success', 'Senha alterada com sucesso!');
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
            'titulo' => 'Visão Geral',
            'professor' => auth('professor')->user(),
            'turmas' => $this->turmaService->getTurmasProfessor(auth('professor')->user()),
            'certificados' => $this->certificadoService->getUltimosCertificadosProfessor(auth('professor')->user()),
        ]);
    }
}
