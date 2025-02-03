<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyPrimeiroAcesso
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        $professor = auth('professor')->user();

        // Verifica se o professor ainda não trocou a senha
        if ($professor && $professor->primeiro_acesso) {
            // Se for primeiro acesso, redireciona para a página de troca de senha
            return redirect()->route('professor.trocarSenha');
        }

        return $next($request);
    }
}
