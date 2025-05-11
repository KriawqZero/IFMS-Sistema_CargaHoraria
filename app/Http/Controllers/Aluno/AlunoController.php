<?php

namespace App\Http\Controllers\Aluno;

use App\Http\Controllers\Controller;
use App\Http\Services\Aluno\AuthService;
use App\Http\Services\Aluno\CertificadoService;
use Illuminate\Http\Request;

class AlunoController extends Controller {
    public function __construct(
        private AuthService $authService,
        private CertificadoService $certificadoService
    ) { }

    /**
     * Exibe o formulário de login do aluno
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm() {
        return view('aluno/login', [
            'titulo' => 'Entrar',
        ]);
    }

    /**
     * Página sobre o sistema
     *
     * @return \Illuminate\View\View
     */
    public function sobre() {
        return view('sobre.sobre', [
            'titulo' => 'Sobre',
        ]);
    }

    /**
     * Dashboard principal do aluno
     *
     * @return \Illuminate\View\View
     */
    public function dashboard() {
        /** @var \App\Models\Aluno $aluno */
        $aluno = auth('aluno')->user();

        return view('aluno.index', [
            'titulo' => 'Visão Geral',
            'aluno' => $aluno,
            'cargaHorariaTotal' => $aluno->cargaHorariaTotal(),
            'maxCargaHoraria' => $aluno->maxCargaHoraria(),
            'certificados' => $this->certificadoService->getCertificadosAluno($aluno)->items(),
            'curso' => $aluno->curso,
        ]);
    }

    /**
     * Processa o logout do aluno
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout() {
        auth('aluno')->logout();
        auth('professor')->logout();
        return redirect()->route('aluno.login');
    }

    /**
     * Processa o login do aluno
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processLogin(Request $request) {
        $request->validate([
            'cpf' => 'required|string|min:11',
            'senha' => 'required|string',
        ]);

        try {
            $aluno = $this->authService->authenticate($request->all());

            auth('aluno')->login($aluno);
            $request->session()->regenerate();

            return redirect()->route('aluno.dashboard');
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            dd($e);
            return back()->withErrors($e->errors())->withInput();
        }
        catch (\Exception $e) {
            
            dd($e);
            return back()->withErrors(['message' => $e->getMessage()])->withInput();
        }
    }
}
