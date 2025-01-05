<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyAuth {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        if($request->routeIs('aluno.login') && session()->has('usuario'))
            return redirect()
                ->route('aluno.dashboard')
                ->withError('Você já está autenticado');

        if($request->session()->has('usuario'))
            return $next($request);

        if(!session()->has('usuario') && !$request->routeIs('aluno.login'))
            return redirect()
                ->route('aluno.login')
                ->withErrors('Você precisa estar autenticado para acessar essa pagina');

        return $next($request);
    }
}
