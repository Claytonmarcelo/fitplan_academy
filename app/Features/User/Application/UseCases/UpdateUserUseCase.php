<?php

namespace App\Features\User\Application\UseCases;

use App\Features\User\Application\DTOs\UpdateUserDTO;
use App\Features\User\Domain\Entities\UserEntity;
use App\Features\User\Domain\Repositories\UserRepositoryInterface;
use App\Shared\Exceptions\BusinessException;
use App\Shared\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Hash;

/**
 * Use Case - Atualizar Usuário
 * 
 * Caso de uso responsável por atualizar um usuário existente.
 * 
 * Responsabilidades:
 * - Buscar usuário existente
 * - Validar email único (se alterado)
 * - Atualizar campos modificados
 * - Persistir alterações
 * 
 * @package App\Features\User\Application\UseCases
 */
class UpdateUserUseCase
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
     * @param UpdateUserDTO $dto
     * @return UserEntity
     * @throws NotFoundException
     * @throws BusinessException
     */
    public function execute(UpdateUserDTO $dto): UserEntity
    {
        // Busca o usuário existente
        $user = $this->userRepository->findById($dto->id);

        if (!$user) {
            throw new NotFoundException('Usuário não encontrado');
        }

        // Atualiza nome se fornecido
        if ($dto->name !== null) {
            $user->updateName($dto->name);
        }

        // Atualiza email se fornecido
        if ($dto->email !== null && $dto->email !== $user->getEmail()) {
            // Regra de negócio: Email deve ser único
            if ($this->userRepository->emailExists($dto->email, $dto->id)) {
                throw new BusinessException('Email já está em uso');
            }
            $user->updateEmail($dto->email);
        }

        // Atualiza senha se fornecida
        if ($dto->password !== null) {
            $hashedPassword = Hash::make($dto->password);
            $user->updatePassword($hashedPassword);
        }

        // Atualiza status se fornecido
        if ($dto->isActive !== null) {
            $dto->isActive ? $user->activate() : $user->deactivate();
        }

        // Persiste as alterações
        return $this->userRepository->save($user);
    }
}

