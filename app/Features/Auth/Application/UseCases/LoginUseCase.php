<?php

namespace App\Features\Auth\Application\UseCases;

use App\Features\Auth\Application\DTOs\LoginDTO;
use App\Features\User\Domain\Repositories\UserRepositoryInterface;
use App\Shared\Exceptions\BusinessException;
use Illuminate\Support\Facades\Hash;

/**
 * Use Case - Login
 * 
 * Caso de uso responsável pela autenticação do usuário.
 * Gera token de acesso usando Laravel Sanctum.
 * 
 * Responsabilidades:
 * - Validar credenciais
 * - Verificar se usuário está ativo
 * - Gerar token de acesso
 * 
 * Performance:
 * - Hash verification é otimizado pelo bcrypt
 * - Tokens são armazenados eficientemente no PostgreSQL
 * 
 * @package App\Features\Auth\Application\UseCases
 */
class LoginUseCase
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
     * @param LoginDTO $dto
     * @return array ['user' => UserEntity, 'token' => string]
     * @throws BusinessException
     */
    public function execute(LoginDTO $dto): array
    {
        // Busca usuário por email
        $user = $this->userRepository->findByEmail($dto->email);

        // Valida se usuário existe
        if (!$user) {
            throw new BusinessException('Credenciais inválidas', 401);
        }

        // Verifica senha
        if (!Hash::check($dto->password, $user->getPassword())) {
            throw new BusinessException('Credenciais inválidas', 401);
        }

        // Verifica se usuário está ativo
        if (!$user->isActive()) {
            throw new BusinessException('Usuário inativo', 403);
        }

        // Gera token de acesso usando Sanctum
        // Performance: Token é armazenado no PostgreSQL de forma eficiente
        $tokenName = 'api-token';
        $abilities = ['*']; // Permissões do token
        
        // Cria o token
        // Note: Precisamos do model Eloquent para criar token
        $userModel = \App\Features\User\Infrastructure\Models\User::find($user->getId());
        $token = $userModel->createToken($tokenName, $abilities)->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}

