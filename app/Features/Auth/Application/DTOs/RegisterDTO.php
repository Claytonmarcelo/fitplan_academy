<?php

namespace App\Features\Auth\Application\DTOs;

/**
 * Data Transfer Object - Register
 * 
 * Encapsula os dados de registro de novo usuário.
 * 
 * @package App\Features\Auth\Application\DTOs
 */
readonly class RegisterDTO
{
    /**
     * Construtor do DTO
     * 
     * @param string $name Nome completo
     * @param string $email Email
     * @param string $password Senha
     */
    public function __construct(
        public string $name,
        public string $email,
        public string $password
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
            name: $data['name'],
            email: $data['email'],
            password: $data['password']
        );
    }
}

