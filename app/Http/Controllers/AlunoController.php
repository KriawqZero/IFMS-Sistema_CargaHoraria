<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Aluno;

class AlunoController extends Controller {
    // Exibe o formulário de login do aluno.
    public function showLoginForm() {
        return view('aluno/login', [
            'titulo' => 'Entrar',
        ]);
    }

    public function dashboard() {
        $aluno = Auth::guard('aluno')->user(); // Obtenha o aluno autenticado
        $certificados = $aluno->certificados; // Todos os certificados do aluno

        // Calculando a carga horária total e por tipo
        $cargaHorariaTotal = $aluno->certificados->sum('carga_horaria');

        // Limites máximos de carga horária por tipo (exemplo de limites)
        $limitesCargaHoraria = [
            'Unidades curriculares optativas/eletivas' => 120,
            'Projetos de ensino, pesquisa e extensão' => 80,
            'Prática profissional integrada' => 80,
            'Práticas desportivas' => 80,
            'Práticas artístico-culturais' => 80,
        ];

        // Calcular a carga horária por tipo
        $cargaHorariaPorTipo = $aluno->certificados->groupBy('tipo')->map(function ($certificados) {
            return $certificados->sum('carga_horaria');
        });

        // Definir o valor máximo de carga horária permitida
        $maxCargaHoraria = array_sum($limitesCargaHoraria); // Soma de todos os limites máximos

        return view('aluno.index', [
            'titulo' => 'Visão Geral',
            'aluno' => $aluno,
            'cargaHorariaTotal' => $cargaHorariaTotal,
            'cargaHorariaPorTipo' => $cargaHorariaPorTipo,
            'limitesCargaHoraria' => $limitesCargaHoraria,
            'maxCargaHoraria' => $maxCargaHoraria,
            'certificados' => $certificados,
        ]);
    }

    // Realiza o logout do aluno.
    public function logout() {
        // Usando o guard 'aluno' para garantir que o logout seja feito corretamente.
        Auth::guard('aluno')->logout();
        return redirect()->route('aluno.login');
    }

    public function showEnviarCertificadoForm() {
        return view('aluno.enviar_certificado', [
            'titulo' => 'Enviar Certificado',
        ]);
    }

    public function detalhamento() {
        $aluno = Auth::guard('aluno')->user(); // Obtenha o aluno autenticado
        $certificados = $aluno->certificados; // Todos os certificados do aluno

        return view('aluno.detalhamento', [
            'titulo' => 'Detalhamento',
            'aluno' => $aluno,
            'certificados' => $certificados,
        ]);
    }

    // Processa o login do aluno.
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
        $response = Http::retry(3, 100)
            ->withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])
            ->get(env('API_URL') . 'Aluno/login', $credentials);

        if ($response->successful()) {
            $responseData = $response->json();

            if ($responseData['valido'] === true) {
                // Verifica se o aluno já existe no banco de dados.
                $aluno = Aluno::firstOrCreate(
                    ['cpf' => $credentials['cpf']], // Condição para busca.
                    [ // Dados a serem inseridos caso o aluno não exista.
                        'nome' => $responseData['nome'] ?? 'Nome não informado',
                        'email' => $responseData['email'] ?? null,
                        'data_nascimento' => $responseData['data_nascimento'] ?? null,
                    ]
                );

                // Autentica o aluno usando o guard 'aluno'.
                Auth::guard('aluno')->login($aluno);

                return redirect()->route('aluno.dashboard');
            }

            return redirect()->route("aluno.login")
                ->withErrors(['message' => 'Usuário ou senha incorretos.'])
                ->withInput();
        }

        return redirect()->route("aluno.login")
            ->withErrors(['message' => 'Falha ao autenticar usuário.'])
            ->withInput();
    }
}

