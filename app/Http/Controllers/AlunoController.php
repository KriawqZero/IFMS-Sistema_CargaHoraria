<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Aluno;

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
        $aluno = Auth::guard('aluno')->user(); // Obter aluno autenticado

        /** @disregard P1013 Undefined Method */
        return view('aluno.index', [
            'titulo' => 'Visão Geral',
            'aluno' => $aluno,
            'cargaHorariaTotal' => $aluno->cargaHorariaTotal(),
            'cargaHorariaPorTipo' => $aluno->cargaHorariaPorTipo(),
            'limitesCargaHoraria' => $aluno->limitesCargaHoraria(),
            'maxCargaHoraria' => $aluno->maxCargaHoraria(),
            'certificados' => $aluno->certificados,
            'curso' => $aluno->curso,
        ]);

    }

    public function logout() {
        Auth::guard('aluno')->logout();
        Auth::guard('professor')->logout();
        return redirect()->route('aluno.login');
    }

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

        $response = Http::retry(3, 100)
            ->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->get(env('API_URL') . 'Aluno/login', $credentials);

        if ($response->successful()) {
            $responseData = $response->json();

            if ($responseData['valido'] === true) {
                $aluno = Aluno::firstOrCreate(
                    ['cpf' => $credentials['cpf']],
                    [
                        'nome' => $responseData['nome'] ?? 'Nome não informado',
                        'email' => $responseData['email'] ?? null,
                        'data_nascimento' => $responseData['data_nascimento'] ?? null,
                    ]
                );

                auth('aluno')->login($aluno);

                return redirect()->route('aluno.dashboard')->with('success', 'Login efetuado com sucesso.');
            }

            return redirect()->route("aluno.login")->withErrors(['message' => 'Usuário ou senha incorretos.'])->withInput();
        }

        return redirect()->route("aluno.login")->withErrors(['message' => 'Falha ao autenticar usuário.'])->withInput();
    }
}

