<?php

namespace App\Features\User\Application\DTOs;

/**
 * Data Transfer Object - Update User
 * 
 * Encapsula os dados para atualizar um usuário existente.
 * Campos opcionais permitem atualização parcial.
 * 
 * @package App\Features\User\Application\DTOs
 */
readonly class UpdateUserDTO
{
    /**
     * Construtor do DTO
     * 
     * @param int $id ID do usuário a ser atualizado
     * @param string|null $name Novo nome (opcional)
     * @param string|null $email Novo email (opcional)
     * @param string|null $password Nova senha (opcional)
     * @param bool|null $isActive Novo status (opcional)
     */
    public function __construct(
        public int $id,
        public ?string $name = null,
        public ?string $email = null,
        public ?string $password = null,
        public ?bool $isActive = null
    ) {}

    /**
     * Cria um DTO a partir de um array
     * 
     * @param int $id
     * @param array $data
     * @return self
     */
    public static function fromArray(int $id, array $data): self
    {
        return new self(
            id: $id,
            name: $data['name'] ?? null,
            email: $data['email'] ?? null,
            password: $data['password'] ?? null,
            isActive: $data['is_active'] ?? null
        );
    }
}

