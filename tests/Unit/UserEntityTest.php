<?php

namespace Tests\Unit;

use App\Features\User\Domain\Entities\UserEntity;
use PHPUnit\Framework\TestCase;

/**
 * Testes Unitários - UserEntity
 * 
 * Testa a entidade de domínio UserEntity isoladamente.
 * Não depende de banco de dados ou framework.
 * 
 * @package Tests\Unit
 */
class UserEntityTest extends TestCase
{
    /**
     * Testa criação de usuário válido
     */
    public function test_can_create_valid_user_entity(): void
    {
        // Arrange & Act
        $user = new UserEntity(
            id: null,
            name: 'João Silva',
            email: 'joao@email.com',
            password: 'hashed_password',
            isActive: true
        );

        // Assert
        $this->assertNull($user->getId());
        $this->assertEquals('João Silva', $user->getName());
        $this->assertEquals('joao@email.com', $user->getEmail());
        $this->assertTrue($user->isActive());
    }

    /**
     * Testa validação de nome inválido
     */
    public function test_cannot_create_user_with_short_name(): void
    {
        // Expect
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('O nome deve ter no mínimo 3 caracteres');

        // Act
        new UserEntity(
            id: null,
            name: 'AB', // Nome muito curto
            email: 'joao@email.com',
            password: 'hashed_password'
        );
    }

    /**
     * Testa validação de email inválido
     */
    public function test_cannot_create_user_with_invalid_email(): void
    {
        // Expect
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Email inválido');

        // Act
        new UserEntity(
            id: null,
            name: 'João Silva',
            email: 'email-invalido', // Email sem @
            password: 'hashed_password'
        );
    }

    /**
     * Testa ativação de usuário
     */
    public function test_can_activate_user(): void
    {
        // Arrange
        $user = new UserEntity(
            id: 1,
            name: 'João Silva',
            email: 'joao@email.com',
            password: 'hashed_password',
            isActive: false
        );

        // Act
        $user->activate();

        // Assert
        $this->assertTrue($user->isActive());
    }

    /**
     * Testa desativação de usuário
     */
    public function test_can_deactivate_user(): void
    {
        // Arrange
        $user = new UserEntity(
            id: 1,
            name: 'João Silva',
            email: 'joao@email.com',
            password: 'hashed_password',
            isActive: true
        );

        // Act
        $user->deactivate();

        // Assert
        $this->assertFalse($user->isActive());
    }

    /**
     * Testa marcação de email como verificado
     */
    public function test_can_mark_email_as_verified(): void
    {
        // Arrange
        $user = new UserEntity(
            id: 1,
            name: 'João Silva',
            email: 'joao@email.com',
            password: 'hashed_password'
        );

        // Act
        $user->markEmailAsVerified();

        // Assert
        $this->assertTrue($user->hasVerifiedEmail());
        $this->assertNotNull($user->getEmailVerifiedAt());
    }

    /**
     * Testa atualização de nome
     */
    public function test_can_update_name(): void
    {
        // Arrange
        $user = new UserEntity(
            id: 1,
            name: 'João Silva',
            email: 'joao@email.com',
            password: 'hashed_password'
        );

        // Act
        $user->updateName('João Santos');

        // Assert
        $this->assertEquals('João Santos', $user->getName());
    }

    /**
     * Testa atualização de email
     */
    public function test_can_update_email(): void
    {
        // Arrange
        $user = new UserEntity(
            id: 1,
            name: 'João Silva',
            email: 'joao@email.com',
            password: 'hashed_password',
            emailVerifiedAt: new \DateTime()
        );

        // Act
        $user->updateEmail('novo@email.com');

        // Assert
        $this->assertEquals('novo@email.com', $user->getEmail());
        // Ao trocar email, deve resetar verificação
        $this->assertNull($user->getEmailVerifiedAt());
    }
}

