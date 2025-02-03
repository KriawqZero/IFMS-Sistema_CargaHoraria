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
        // Obtém os guards configurados no sistema.
        $guards = array_keys(config('auth.guards'));
        if ($guard === "all") {
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

        if($guard === "none") {
            foreach($guards as $specificGuard) {
                if(auth($specificGuard)->check()) {
                    return redirect()
                        ->route("$specificGuard.dashboard")
                        ->withErrors('Você já está autenticado.');
                }
            }
        }

        return $next($request);
    }
}

