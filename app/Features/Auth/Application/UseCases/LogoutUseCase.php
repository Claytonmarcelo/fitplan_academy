<?php

namespace App\Features\Auth\Application\UseCases;

use Illuminate\Http\Request;

/**
 * Use Case - Logout
 * 
 * Caso de uso para logout do usuário.
 * Revoga o token de acesso atual.
 * 
 * @package App\Features\Auth\Application\UseCases
 */
class LogoutUseCase
{
    /**
     * Executa o caso de uso
     * 
     * @param Request $request
     * @return void
     */
    public function execute(Request $request): void
    {
        // Revoga o token atual do usuário
        // Sanctum automaticamente gerencia os tokens
        $request->user()->currentAccessToken()->delete();
    }
}

