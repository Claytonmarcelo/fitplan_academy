<?php

namespace App\Features\User\Domain\Repositories;

use App\Features\User\Domain\Entities\UserEntity;

/**
 * Interface do Repositório de Usuários
 * 
 * Define o contrato para persistência de usuários.
 * Esta interface é parte do domínio e não conhece detalhes de implementação.
 * 
 * Seguindo o Dependency Inversion Principle (SOLID):
 * - O domínio define a interface
 * - A infraestrutura implementa a interface
 * 
 * @package App\Features\User\Domain\Repositories
 */
interface UserRepositoryInterface
{
    /**
     * Busca um usuário por ID
     * 
     * @param int $id
     * @return UserEntity|null
     */
    public function findById(int $id): ?UserEntity;

    /**
     * Busca um usuário por email
     * 
     * @param string $email
     * @return UserEntity|null
     */
    public function findByEmail(string $email): ?UserEntity;

    /**
     * Lista todos os usuários com paginação
     * 
     * @param int $perPage Itens por página
     * @param int $page Página atual
     * @return array Array com ['data' => UserEntity[], 'total' => int, 'per_page' => int, 'current_page' => int]
     */
    public function findAll(int $perPage = 15, int $page = 1): array;

    /**
     * Salva (cria ou atualiza) um usuário
     * 
     * @param UserEntity $user
     * @return UserEntity Usuário salvo com ID preenchido
     */
    public function save(UserEntity $user): UserEntity;

    /**
     * Deleta um usuário
     * 
     * @param int $id
     * @return bool Sucesso da operação
     */
    public function delete(int $id): bool;

    /**
     * Verifica se um email já existe
     * 
     * @param string $email
     * @param int|null $exceptId ID para excluir da verificação (útil em updates)
     * @return bool
     */
    public function emailExists(string $email, ?int $exceptId = null): bool;
}

