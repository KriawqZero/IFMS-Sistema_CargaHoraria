<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyAuth {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $guard
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $guard): Response {
        // Verifica se o usuário está autenticado pelo guard especificado.
        if (Auth::guard($guard)->check()) {
            // Redireciona caso já esteja autenticado e tente acessar a rota de login.
            if ($request->routeIs("$guard.login")) {
                return redirect()
                    ->route("$guard.dashboard")
                    ->withErrors(['message' => 'Você já está autenticado.']);
            }

            return $next($request);
        }

        // Redireciona para o login se não estiver autenticado.
        if (!$request->routeIs("$guard.login")) {
            return redirect()
                ->route("aluno.login")
                ->withErrors(['message' => 'Você precisa estar autenticado para acessar esta página.']);
        }

        return $next($request);
    }
}

