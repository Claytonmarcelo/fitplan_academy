<?php

namespace App\Features\User\Application\UseCases;

use App\Features\User\Domain\Entities\UserEntity;
use App\Features\User\Domain\Repositories\UserRepositoryInterface;
use App\Shared\Exceptions\NotFoundException;

/**
 * Use Case - Buscar Usuário
 * 
 * Caso de uso simples para buscar um usuário por ID.
 * 
 * @package App\Features\User\Application\UseCases
 */
class GetUserUseCase
{
    /**
     * Construtor com injeção de dependência
     * 
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    /**
     * Executa o caso de uso
     * 
     * @param int $id
     * @return UserEntity
     * @throws NotFoundException
     */
    public function execute(int $id): UserEntity
    {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            throw new NotFoundException('Usuário não encontrado');
        }

        return $user;
    }
}

