<?php

namespace App\Http\Controllers\Aluno;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Aluno;
use App\Models\Certificado;

class AlunoController extends Controller {
    public function showLoginForm() {
        return view('aluno/login', [
            'titulo' => 'Entrar',
        ]);
    }

    public function sobre() {
        return view('sobre.sobre', [
            'titulo' => 'Sobre',
        ]);
    }

    public function dashboard() {
        $aluno = auth('aluno')->user(); // Obter aluno autenticado

        $certificados = Certificado::where('aluno_id', $aluno->id)
            ->latest()
            ->paginate(5);

        /** @disregard P1013 Undefined Method */
        return view('aluno.index', [
            'titulo' => 'Visão Geral',
            'aluno' => $aluno,
            'cargaHorariaTotal' => $aluno->cargaHorariaTotal(),
            'cargaHorariaPorTipo' => $aluno->cargaHorariaPorTipo(),
            'limitesCargaHoraria' => $aluno->limitesCargaHorariaPorTipo(),
            'maxCargaHoraria' => $aluno->maxCargaHoraria(),
            'certificados' => $certificados->items(),
            'curso' => $aluno->curso,
        ]);

    }

    public function logout() {
        Auth::guard('aluno')->logout();
        Auth::guard('professor')->logout();
        return redirect()->route('aluno.login');
    }

    // Pra login com senha
    public function processLogin(Request $request) {
        auth('professor')->logout();

        $credentials = $request->validate([
            'cpf' => 'required|string',
            'senha' => 'required|string',
        ]);

        $token = session('token');
        if (!$token) {
            return back()->withErrors(['message' => 'Permissão negada. Token ausente.'])->withInput();
        }

        $response = Http::withToken($token)
                ->get(env('API_URL') . 'Aluno/login', $credentials);

        if (!$response->successful()) {
            return redirect()->route("aluno.login")->withErrors(['message' => 'Falha ao autenticar usuário.'])->withInput();
        }

        $responseData = $response->json();

        if (!$responseData['valido']) {
            return redirect()->route("aluno.login")->withErrors(['message' => 'CPF ou senha incorretos.'])->withInput();
        }

        // else
        $aluno = Aluno::updateOrCreate(
            ['cpf' => $credentials['cpf']],
            [
                'nome' => $responseData['nome'] ?? 'Nome não informado',
                'email' => $responseData['email'] ?? null,
                'data_nascimento' => $responseData['data_nascimento'] ?? null,
            ]
        );

        $request->session()->regenerate();
        auth('aluno')->login($aluno);

        return redirect()->route('aluno.dashboard');
    }
}

