<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

/**
 * Handler de exceções da aplicação
 * 
 * Este arquivo define como as exceções são tratadas e
 * reportadas pela aplicação Laravel.
 */
class Handler extends ExceptionHandler
{
    /**
     * Lista de inputs que nunca devem aparecer em exceções de validação
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Registra callbacks de tratamento de exceções
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
