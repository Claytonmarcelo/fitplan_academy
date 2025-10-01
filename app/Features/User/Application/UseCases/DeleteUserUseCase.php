<?php

namespace App\Features\User\Application\UseCases;

use App\Features\User\Domain\Repositories\UserRepositoryInterface;
use App\Shared\Exceptions\NotFoundException;

/**
 * Use Case - Deletar Usuário
 * 
 * Caso de uso para deletar um usuário do sistema.
 * 
 * @package App\Features\User\Application\UseCases
 */
class DeleteUserUseCase
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
     * @return bool
     * @throws NotFoundException
     */
    public function execute(int $id): bool
    {
        // Verifica se o usuário existe
        $user = $this->userRepository->findById($id);

        if (!$user) {
            throw new NotFoundException('Usuário não encontrado');
        }

        // Deleta o usuário
        return $this->userRepository->delete($id);
    }
}

