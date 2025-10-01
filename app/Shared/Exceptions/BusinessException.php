<?php

namespace App\Shared\Exceptions;

use Exception;

/**
 * Business Exception
 * 
 * Exceção para erros de regras de negócio.
 * Retorna HTTP 422 (Unprocessable Entity) nas APIs.
 * 
 * Exemplos:
 * - Email já em uso
 * - Saldo insuficiente
 * - Operação não permitida
 * 
 * @package App\Shared\Exceptions
 */
class BusinessException extends Exception
{
    /**
     * Código HTTP padrão para erros de negócio
     */
    protected $code = 422;

    /**
     * Construtor
     * 
     * @param string $message Mensagem de erro
     * @param int $code Código HTTP (padrão: 422)
     */
    public function __construct(string $message, int $code = 422)
    {
        parent::__construct($message, $code);
    }
}

