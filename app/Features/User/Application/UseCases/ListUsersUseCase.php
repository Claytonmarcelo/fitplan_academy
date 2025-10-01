<?php

namespace App\Features\User\Application\UseCases;

use App\Features\User\Domain\Repositories\UserRepositoryInterface;

/**
 * Use Case - Listar Usuários
 * 
 * Caso de uso para listar usuários com paginação.
 * 
 * @package App\Features\User\Application\UseCases
 */
class ListUsersUseCase
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
     * @param int $perPage Itens por página
     * @param int $page Página atual
     * @return array
     */
    public function execute(int $perPage = 15, int $page = 1): array
    {
        return $this->userRepository->findAll($perPage, $page);
    }
}

