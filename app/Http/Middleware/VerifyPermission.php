<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyPermission {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $cargo): Response {
        /** @var \App\Models\Professor $professor */
        $professor = auth('professor')->user();

        if($professor->cargo != $cargo) {
            return back()
                ->withErrors(['message' => 'Você não tem permissão pra realizar essa ação.']);
        }

        return $next($request);
    }
}
