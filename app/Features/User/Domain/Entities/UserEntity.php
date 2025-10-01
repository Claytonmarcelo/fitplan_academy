<?php

namespace App\Features\User\Domain\Entities;

use DateTime;

/**
 * Entidade de Domínio - User
 * 
 * Representa um usuário no domínio da aplicação.
 * Esta é uma entidade pura, sem dependências do framework,
 * contendo apenas regras de negócio.
 * 
 * @package App\Features\User\Domain\Entities
 */
class UserEntity
{
    /**
     * Construtor da entidade User
     * 
     * @param int|null $id ID do usuário
     * @param string $name Nome completo
     * @param string $email Email (único)
     * @param string $password Senha hasheada
     * @param bool $isActive Status ativo/inativo
     * @param DateTime|null $emailVerifiedAt Data de verificação do email
     * @param DateTime|null $createdAt Data de criação
     * @param DateTime|null $updatedAt Data de atualização
     */
    public function __construct(
        private ?int $id,
        private string $name,
        private string $email,
        private string $password,
        private bool $isActive = true,
        private ?DateTime $emailVerifiedAt = null,
        private ?DateTime $createdAt = null,
        private ?DateTime $updatedAt = null
    ) {
        $this->validateName($name);
        $this->validateEmail($email);
    }

    /**
     * Valida o nome do usuário
     * Regra de negócio: Nome deve ter no mínimo 3 caracteres
     */
    private function validateName(string $name): void
    {
        if (strlen(trim($name)) < 3) {
            throw new \InvalidArgumentException('O nome deve ter no mínimo 3 caracteres');
        }
    }

    /**
     * Valida o email do usuário
     * Regra de negócio: Email deve ser válido
     */
    private function validateEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Email inválido');
        }
    }

    // Getters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function getEmailVerifiedAt(): ?DateTime
    {
        return $this->emailVerifiedAt;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    // Métodos de negócio

    /**
     * Ativa o usuário
     * Regra de negócio: Usuário pode ser ativado
     */
    public function activate(): void
    {
        $this->isActive = true;
    }

    /**
     * Desativa o usuário
     * Regra de negócio: Usuário pode ser desativado
     */
    public function deactivate(): void
    {
        $this->isActive = false;
    }

    /**
     * Marca o email como verificado
     */
    public function markEmailAsVerified(): void
    {
        if ($this->emailVerifiedAt === null) {
            $this->emailVerifiedAt = new DateTime();
        }
    }

    /**
     * Verifica se o email foi verificado
     */
    public function hasVerifiedEmail(): bool
    {
        return $this->emailVerifiedAt !== null;
    }

    /**
     * Atualiza o nome do usuário
     */
    public function updateName(string $name): void
    {
        $this->validateName($name);
        $this->name = $name;
    }

    /**
     * Atualiza o email do usuário
     */
    public function updateEmail(string $email): void
    {
        $this->validateEmail($email);
        $this->email = $email;
        // Ao mudar o email, deve reverificar
        $this->emailVerifiedAt = null;
    }

    /**
     * Atualiza a senha do usuário
     */
    public function updatePassword(string $hashedPassword): void
    {
        $this->password = $hashedPassword;
    }
}

