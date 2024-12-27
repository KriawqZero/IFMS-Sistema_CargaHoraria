<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AlunoController extends Controller {
    public function loginForm() {
        return view('Login/studentLogin');
    }

    public function index() {
        return view('welcome');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'cpf' => 'required|string',
            'senha' => 'required|string',
        ]);

        $token = session('token');

        if(!$token)
            return response()->json(['message' => 'Permissão negada. Token ausente']);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('http://localhost:5000/api/Aluno/login', $credentials);

        if($response->successful()) {
            $userData = $response->json();
            return response()->json($userData);
        }

        return response()->json([
            'message' => 'Falha ao autenticar usuario',
            'details' => $response->body(),
        ], $response->status());
    }
}
