<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

/**
 * Bootstrap da aplicação Laravel
 * 
 * Este arquivo é responsável por configurar a aplicação Laravel,
 * incluindo middlewares, exceções e configurações globais.
 */

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Configuração de middlewares globais
        // Adicione aqui middlewares customizados se necessário
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Configuração de tratamento de exceções
        // Personalize o tratamento de exceções aqui
    })->create();

