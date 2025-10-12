<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RefreshCsrfToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Se for uma requisição AJAX e o token CSRF estiver expirado
        if ($request->ajax() && $request->session()->token() !== $request->input('_token')) {
            // Regenerar o token CSRF
            $request->session()->regenerateToken();
            
            // Retornar uma resposta JSON com o novo token
            return response()->json([
                'error' => 'csrf_expired',
                'message' => 'Token CSRF expirado. Tente novamente.',
                'new_token' => $request->session()->token()
            ], 419);
        }

        return $next($request);
    }
}