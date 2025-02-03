<?php

namespace App\Http\Controllers\Professor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Professor\AuthService;
use App\Http\Services\Professor\CertificadoService;
use App\Http\Services\Professor\TurmaService;
use App\Models\Professor;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfessorController extends Controller
{
    // Injeção de dependência dos serviços
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

            // Verifica se o professor é um novo usuário
            if ($professor->primeiro_acesso) {
                // Se for, redireciona para a página de troca de senha
                auth('professor')->login($professor);
                return redirect()->route('professor.trocarSenha');
            }

            // Login e redirecionamento
            auth('professor')->login($professor);
            return redirect()->route('professor.dashboard');

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['login' => $e->getMessage()]);
        }
    }

    public function trocarSenhaForm() {
        return view('professor.trocarSenha', [
            'titulo' => 'Trocar Senha',
        ]);
    }

    public function trocarSenha(Request $request) {
        // Validação das senhas
        $request->validate([
            'nova_senha' => 'required|string|min:8|confirmed',
        ]);

        $professor = auth('professor')->user();

        // Salva as alterações
        Professor::where('id', $professor->id)->update([
            'senha' => Hash::make($request->nova_senha),
            'primeiro_acesso' => false,
        ]);

        // Redireciona para o dashboard após a troca de senha
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
            'titulo' => 'Professor',
            'professor' => auth('professor')->user(),
            'turmas' => $this->turmaService->getTurmasProfessor(auth('professor')->id()),
            'certificados' => $this->certificadoService->getUltimosCertificadosProfessor(auth('professor')->user()),
        ]);
    }
}
