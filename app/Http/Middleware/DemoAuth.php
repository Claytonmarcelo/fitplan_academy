<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware para simular autenticação de usuários em modo demo
 */
class DemoAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar se há usuário demo na sessão
        if (!session()->has('demo_user')) {
            return redirect()->route('login')->withErrors(['login' => 'Sessão expirada. Faça login novamente.']);
        }

        return $next($request);
    }
}
