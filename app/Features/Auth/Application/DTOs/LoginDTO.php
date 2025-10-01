<?php

namespace App\Features\Auth\Application\DTOs;

/**
 * Data Transfer Object - Login
 * 
 * Encapsula os dados de login do usuário.
 * 
 * @package App\Features\Auth\Application\DTOs
 */
readonly class LoginDTO
{
    /**
     * Construtor do DTO
     * 
     * @param string $email Email do usuário
     * @param string $password Senha em texto plano
     * @param bool $remember Manter login (remember me)
     */
    public function __construct(
        public string $email,
        public string $password,
        public bool $remember = false
    ) {}

    /**
     * Cria um DTO a partir de um array
     * 
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            email: $data['email'],
            password: $data['password'],
            remember: $data['remember'] ?? false
        );
    }
}

