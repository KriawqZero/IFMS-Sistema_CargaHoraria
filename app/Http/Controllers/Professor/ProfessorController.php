<?php

namespace App\Http\Controllers\Professor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfessorController extends Controller {
    public function showLoginForm() {
        return view('professor/login', [
            'titulo' => 'Login Servidor',
        ]);
    }

    public function dashboard() {
        $professor = auth('professor')->user();

        return view('professor/index', [
            'titulo' => 'Servidor',
            'professor' => $professor,
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

        // if
        if ($credentials['login'] !== 'professor.davi' && $credentials['senha'] != '123')
            return redirect() ->route('professor.login') ->withErrors('Login ou senha inválidos');

        // else
        auth('professor')->loginUsingId(1);
            return redirect()->route('professor.dashboard');
    }
}
