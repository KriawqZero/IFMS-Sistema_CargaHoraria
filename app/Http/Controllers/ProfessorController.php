<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfessorController extends Controller {
    public function showLoginForm() {
        return view('professor/login', [
            'titulo' => 'Servidor',
        ]);
    }

    public function dashboard() {
        return view('professor/dashboard', [
            'titulo' => 'Servidor',
        ]);
    }

    public function processLogin(Request $request) {
        $login = $request->input('login');
        $senha = $request->input('senha');

        if ($login == 'professor' && $senha == '123') {
            $request->session()->put('usuario', 'professor');
            return redirect()->route('professor.dashboard');
        } else {
            return redirect()->route('professor.login');
        }
    }
}
