<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;

class VerifyJWT {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        // Faz login na API para obter o token
        $username = 'laravel';
        $password = 'certificado123';

        $response = Http::post(env('API_URL') . '/Auth/login', [
            'username' => $username,
            'password' => $password,
        ]);

        if ($response->successful()) {
            // Armazena o token na sessão
            $token = $response->json()['token'];
            session(['token' => $token]);
        } else {
            // Retorna erro caso o login na API falhe
            return response()->json([
                'message' => 'Falha ao obter token JWT da API',
                'details' => $response->body(),
            ], $response->status());
        }

        // Permite que a solicitação prossiga
        return $next($request);
    }
}
