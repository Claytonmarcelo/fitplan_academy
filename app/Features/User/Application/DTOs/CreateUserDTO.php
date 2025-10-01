<?php

namespace App\Features\User\Application\DTOs;

/**
 * Data Transfer Object - Create User
 * 
 * Encapsula os dados necessários para criar um novo usuário.
 * DTOs são imutáveis e servem apenas para transferir dados entre camadas.
 * 
 * @package App\Features\User\Application\DTOs
 */
readonly class CreateUserDTO
{
    /**
     * Construtor do DTO
     * 
     * @param string $name Nome completo do usuário
     * @param string $email Email do usuário
     * @param string $password Senha em texto plano (será hasheada)
     * @param bool $isActive Status inicial do usuário
     */
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public bool $isActive = true
    ) {}

    /**
     * Cria um DTO a partir de um array
     * Útil para criar a partir de requests HTTP
     * 
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
            isActive: $data['is_active'] ?? true
        );
    }
}

