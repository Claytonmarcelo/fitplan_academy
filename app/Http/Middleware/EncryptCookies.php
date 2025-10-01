<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

/**
 * Middleware - Encrypt Cookies
 * 
 * Criptografa cookies automaticamente para segurança.
 * 
 * @package App\Http\Middleware
 */
class EncryptCookies extends Middleware
{
    /**
     * Cookies que não devem ser criptografados
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}

