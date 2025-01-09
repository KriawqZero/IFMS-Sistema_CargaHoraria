<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function processLogin(Request $request) {
        // Valida os campos de entrada.
        auth('aluno')->logout();
        $credentials = $request->validate([
            'login' => 'required|string',
            'senha' => 'required|string',
        ]);

        if ($credentials['login'] == 'professor.davi' && $credentials['senha'] == '123') {
            auth('professor')->loginUsingId(1);
            return redirect()->route('professor.dashboard');
        } else {
            return redirect()
                ->route('professor.login')
                ->withErrors('Login ou senha inválidos');
        }
    }
}
