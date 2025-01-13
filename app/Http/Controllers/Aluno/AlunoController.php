<?php

namespace App\Http\Controllers\Aluno;

use App\Http\Controllers\Controller;
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
        Auth::guard('admin')->logout();
        return redirect()->route('aluno.login');
    }

    // Pra login com senha
    /*public function processLogin(Request $request) {*/
    /*    auth('professor')->logout();*/
    /**/
    /*    $credentials = $request->validate([*/
    /*        'cpf' => 'required|string',*/
    /*        'senha' => 'required|string',*/
    /*    ]);*/
    /**/
    /*    $token = session('token');*/
    /*    if (!$token) {*/
    /*        return back()->withErrors(['message' => 'Permissão negada. Token ausente.'])->withInput();*/
    /*    }*/
    /**/
    /*    $response = Http::retry(3, 100)*/
    /*        ->withHeaders(['Authorization' => 'Bearer ' . $token])*/
    /*        ->get(env('API_URL') . 'Aluno/login', $credentials);*/
    /**/
    /*    // if*/
    /*    if (!$response->successful())*/
    /*        return redirect()->route("aluno.login")->withErrors(['message' => 'Usuário ou senha incorretos.'])->withInput();*/
    /**/
    /*    $responseData = $response->json();*/
    /**/
    /*    // if*/
    /*    if (!$responseData['valido'])*/
    /*        return redirect()->route("aluno.login")->withErrors(['message' => 'Falha ao autenticar usuário.'])->withInput();*/
    /**/
    /*    // else*/
    /*    $aluno = Aluno::firstOrCreate(*/
    /*        ['cpf' => $credentials['cpf']],*/
    /*        [*/
    /*            'nome' => $responseData['nome'] ?? 'Nome não informado',*/
    /*            'email' => $responseData['email'] ?? null,*/
    /*            'data_nascimento' => $responseData['data_nascimento'] ?? null,*/
    /*        ]*/
    /*    );*/
    /**/
    /*    $request->session()->regenerate();*/
    /*    auth('aluno')->login($aluno);*/
    /**/
    /*    return redirect()->route('aluno.dashboard');*/
    /*}*/
    /**/

    public function processLogin(Request $request) {
        auth('admin')->logout();
        auth('professor')->logout();

        $credentials = $request->validate([
            'cpf' => 'required|string',
            'data_nascimento' => 'required|date_format:d/m/Y', // Validar o formato da data
        ]);

        // Converter a data para o formato yyyy-mm-dd
        $data_nascimento_formatada = \Carbon\Carbon::createFromFormat('d/m/Y', $credentials['data_nascimento'])
        ->format('Y-m-d'); // Formatar para yyyy-mm-dd

        $token = session('token');
        if (!$token) {
            return back()->withErrors(['message' => 'Permissão negada. Token ausente.'])->withInput();
        }

        $response = Http::retry(3, 100)
            ->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->get(env('API_URL') . 'Aluno/login/data', [
                'cpf' => $credentials['cpf'],
                'data_nascimento' => $data_nascimento_formatada, // Passar a data de nascimento para autenticação
            ]);

        if (!$response->successful()) {
            return redirect()->route("aluno.login")->withErrors(['message' => 'Usuário ou dados incorretos.'])->withInput();
        }

        $responseData = $response->json();

        if (!$responseData['valido']) {
            return redirect()->route("aluno.login")->withErrors(['message' => 'Falha ao autenticar usuário.'])->withInput();
        }

        // Verificar se o aluno já existe e criar se não
        $aluno = Aluno::firstOrCreate(
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

