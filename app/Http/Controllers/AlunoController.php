<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Aluno; // Certifique-se de ter o model Aluno configurado corretamente.

class AlunoController extends Controller {
    public function showLoginForm() {
        return view('aluno/login', [
            'titulo' => 'Entrar',
            'noHeader' => true,
        ]);
    }

    public function dashboard() {
        return view('aluno/dashboard', [
            'titulo' => 'Visão Geral',
        ]);
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('aluno.login');
    }

    public function processLogin(Request $request) {
        // Valida os campos de entrada.
        $credentials = $request->validate([
            'cpf' => 'required|string',
            'senha' => 'required|string',
        ]);

        $token = session('token');

        if (!$token) {
            return back()
                ->withErrors(['message' => 'Permissão negada. Token ausente.'])
                ->withInput();
        }

        // Envia requisição à API externa.
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post(env('API_URL') . 'Aluno/login', $credentials);

        if ($response->successful()) {
            $responseData = $response->json();

            if ($responseData['valido'] === true) {
                // Verifica se o aluno já existe no banco de dados.
                $aluno = Aluno::firstOrCreate(
                    ['cpf' => $credentials['cpf']], // Condição para busca.
                    [ // Dados a serem inseridos caso o aluno não exista.
                        'nome' => $responseData['nome'] ?? 'Nome não informado',
                        'email' => $responseData['email'] ?? null,
                        'turma' => $responseData['turma'] ?? null,
                    ]
                );

                // Autentica o usuário.
                Auth::login($aluno);

                return redirect()->route('aluno.dashboard');
            }

            return back()
                ->withErrors(['message' => 'Usuário ou senha incorretos.'])
                ->withInput();
        }

        return back()
            ->withErrors(['message' => 'Falha ao autenticar usuário.'])
            ->withInput();
    }
}

