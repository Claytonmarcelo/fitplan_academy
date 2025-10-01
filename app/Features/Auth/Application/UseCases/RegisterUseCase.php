<?php

namespace App\Features\Auth\Application\UseCases;

use App\Features\Auth\Application\DTOs\RegisterDTO;
use App\Features\User\Application\DTOs\CreateUserDTO;
use App\Features\User\Application\UseCases\CreateUserUseCase;
use App\Features\User\Domain\Entities\UserEntity;

/**
 * Use Case - Register
 * 
 * Caso de uso para registro de novos usuários.
 * Reutiliza o CreateUserUseCase para evitar duplicação de código.
 * 
 * @package App\Features\Auth\Application\UseCases
 */
class RegisterUseCase
{
    /**
     * Construtor com injeção de dependência
     * 
     * @param CreateUserUseCase $createUserUseCase
     */
    public function __construct(
        private CreateUserUseCase $createUserUseCase
    ) {}

    /**
     * Executa o caso de uso
     * 
     * @param RegisterDTO $dto
     * @return UserEntity
     */
    public function execute(RegisterDTO $dto): UserEntity
    {
        // Converte RegisterDTO para CreateUserDTO
        $createUserDTO = new CreateUserDTO(
            name: $dto->name,
            email: $dto->email,
            password: $dto->password,
            isActive: true
        );

        // Reutiliza o caso de uso de criação de usuário
        return $this->createUserUseCase->execute($createUserDTO);
    }
}

