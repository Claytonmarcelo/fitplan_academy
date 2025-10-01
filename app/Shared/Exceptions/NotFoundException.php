<?php

namespace App\Shared\Exceptions;

use Exception;

/**
 * Not Found Exception
 * 
 * Exceção para recursos não encontrados.
 * Retorna HTTP 404 (Not Found) nas APIs.
 * 
 * Exemplos:
 * - Usuário não encontrado
 * - Produto não existe
 * 
 * @package App\Shared\Exceptions
 */
class NotFoundException extends Exception
{
    /**
     * Código HTTP padrão para recursos não encontrados
     */
    protected $code = 404;

    /**
     * Construtor
     * 
     * @param string $message Mensagem de erro
     * @param int $code Código HTTP (padrão: 404)
     */
    public function __construct(string $message = 'Recurso não encontrado', int $code = 404)
    {
        parent::__construct($message, $code);
    }
}

