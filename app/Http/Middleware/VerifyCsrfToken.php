<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

/**
 * Middleware - Verify CSRF Token
 * 
 * Verifica token CSRF para proteção contra ataques CSRF.
 * APIs REST geralmente não precisam de CSRF (usam tokens de autenticação).
 * 
 * @package App\Http\Middleware
 */
class VerifyCsrfToken extends Middleware
{
    /**
     * URIs que devem ser excluídas da verificação CSRF
     *
     * @var array<int, string>
     */
    protected $except = [
        // Rotas de API geralmente não precisam de CSRF
        'api/*',
    ];
}

