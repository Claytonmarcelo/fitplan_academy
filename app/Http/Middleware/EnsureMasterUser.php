<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * EnsureMasterUser Middleware
 * 
 * Verifica se o usuário autenticado tem perfil Master.
 * Usado para proteger rotas administrativas.
 */
class EnsureMasterUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                           ->withErrors(['access' => 'Você precisa estar logado para acessar esta página.']);
        }

        if (!Auth::user()->isMaster()) {
            abort(403, 'Acesso negado. Apenas usuários Master podem acessar esta funcionalidade.');
        }

        return $next($request);
    }
}
