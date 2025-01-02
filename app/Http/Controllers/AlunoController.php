<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AlunoController extends Controller {
    public function showLoginForm() {
        return view('Login/alunoLogin');
    }

    public function index() {
        return view('Index/alunoIndex');
    }

    public function processLogin(Request $request) {
        $credentials = $request->validate([
            'cpf' => 'required|string',
            'senha' => 'required|string',
        ]);

        $token = session('token');

        if(!$token)
            return response()->json(['message' => 'Permissão negada. Token ausente'], 403);

        $headers = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ]);
        $response = $headers->get(env('API_URL') . 'Aluno/login', $credentials);

        if($response->successful()) {
            $responseData = $response->json();

            if($responseData['valido'] == true) {
                session(['usuario' => $responseData]);
                return redirect()->route('aluno.index');
            }

            return back()
                ->withErrors(['message' => 'Usuario ou senha incorretos.'])
                ->withInput();
        }

        return response()->json([
            'message' => 'Falha ao autenticar usuario',
            'details' => $response->body(),
        ], $response->status());
    }
}


