<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
          // Se o guard for "all", verifica todos os guards configurados.
        if ($guard === "all") {
            // Obtém os guards configurados no sistema.
            $guards = array_keys(config('auth.guards'));

            foreach ($guards as $specificGuard) {
                // Se algum guard estiver autenticado, segue o fluxo.
                if (auth($specificGuard)->check()) {
                    return $next($request);
                }
            }

            // Redireciona para login se nenhum guard estiver autenticado.
            return redirect()
                ->route("aluno.login")
                ->withErrors(['message' => 'Você precisa estar autenticado para acessar esta página.']);
        }

        // Verifica se o usuário está autenticado pelo guard especificado.
        if (auth($guard)->check()) {
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

