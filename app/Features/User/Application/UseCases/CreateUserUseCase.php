<?php

namespace App\Features\User\Application\UseCases;

use App\Features\User\Application\DTOs\CreateUserDTO;
use App\Features\User\Domain\Entities\UserEntity;
use App\Features\User\Domain\Repositories\UserRepositoryInterface;
use App\Shared\Exceptions\BusinessException;
use Illuminate\Support\Facades\Hash;

/**
 * Use Case - Criar Usuário
 * 
 * Caso de uso responsável por criar um novo usuário no sistema.
 * Contém toda a lógica de aplicação para esta operação.
 * 
 * Responsabilidades:
 * - Validar se o email já existe
 * - Hash da senha
 * - Criar a entidade de domínio
 * - Persistir via repositório
 * 
 * @package App\Features\User\Application\UseCases
 */
class CreateUserUseCase
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
     * @param CreateUserDTO $dto
     * @return UserEntity
     * @throws BusinessException
     */
    public function execute(CreateUserDTO $dto): UserEntity
    {
        // Regra de negócio: Email deve ser único
        if ($this->userRepository->emailExists($dto->email)) {
            throw new BusinessException('Email já está em uso');
        }

        // Hash da senha para segurança
        // Performance: bcrypt é adequado para senhas
        $hashedPassword = Hash::make($dto->password);

        // Cria a entidade de domínio
        $user = new UserEntity(
            id: null, // Será gerado pelo banco
            name: $dto->name,
            email: $dto->email,
            password: $hashedPassword,
            isActive: $dto->isActive
        );

        // Persiste no banco de dados
        return $this->userRepository->save($user);
    }
}

