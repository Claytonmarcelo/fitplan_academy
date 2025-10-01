<?php

namespace App\Features\User\Infrastructure\Repositories;

use App\Features\User\Domain\Entities\UserEntity;
use App\Features\User\Domain\Repositories\UserRepositoryInterface;
use App\Features\User\Infrastructure\Models\User;
use DateTime;

/**
 * Implementação do Repositório de Usuários
 * 
 * Implementa a interface do domínio usando Eloquent ORM.
 * Esta classe é responsável por converter entre:
 * - Eloquent Models (Infraestrutura) <-> Domain Entities (Domínio)
 * 
 * Performance Tips:
 * - Usa query builder otimizado do Eloquent
 * - Aproveita índices do PostgreSQL
 * - Implementa paginação eficiente
 * 
 * @package App\Features\User\Infrastructure\Repositories
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * Construtor com injeção de dependência do Model
     * 
     * @param User $model
     */
    public function __construct(
        private User $model
    ) {}

    /**
     * {@inheritDoc}
     */
    public function findById(int $id): ?UserEntity
    {
        $user = $this->model->find($id);
        
        return $user ? $this->toEntity($user) : null;
    }

    /**
     * {@inheritDoc}
     */
    public function findByEmail(string $email): ?UserEntity
    {
        // Performance: Email tem índice único no PostgreSQL
        $user = $this->model->where('email', $email)->first();
        
        return $user ? $this->toEntity($user) : null;
    }

    /**
     * {@inheritDoc}
     */
    public function findAll(int $perPage = 15, int $page = 1): array
    {
        // Performance: Paginação nativa do Laravel com PostgreSQL
        $paginator = $this->model
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        return [
            'data' => array_map(
                fn($user) => $this->toEntity($user),
                $paginator->items()
            ),
            'total' => $paginator->total(),
            'per_page' => $paginator->perPage(),
            'current_page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function save(UserEntity $user): UserEntity
    {
        // Determina se é criação ou atualização
        $model = $user->getId() 
            ? $this->model->findOrFail($user->getId())
            : new User();

        // Preenche os dados
        $model->name = $user->getName();
        $model->email = $user->getEmail();
        $model->password = $user->getPassword();
        $model->is_active = $user->isActive();
        $model->email_verified_at = $user->getEmailVerifiedAt();

        // Performance: save() é otimizado pelo Eloquent
        $model->save();

        // Retorna a entidade atualizada com ID
        return $this->toEntity($model);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(int $id): bool
    {
        $user = $this->model->find($id);
        
        if (!$user) {
            return false;
        }

        // Performance: Delete direto no banco via Eloquent
        return $user->delete();
    }

    /**
     * {@inheritDoc}
     */
    public function emailExists(string $email, ?int $exceptId = null): bool
    {
        $query = $this->model->where('email', $email);
        
        if ($exceptId !== null) {
            $query->where('id', '!=', $exceptId);
        }

        // Performance: exists() é mais rápido que count()
        return $query->exists();
    }

    /**
     * Converte Eloquent Model para Domain Entity
     * 
     * Esta conversão mantém o domínio isolado da infraestrutura
     * 
     * @param User $model
     * @return UserEntity
     */
    private function toEntity(User $model): UserEntity
    {
        return new UserEntity(
            id: $model->id,
            name: $model->name,
            email: $model->email,
            password: $model->password,
            isActive: $model->is_active,
            emailVerifiedAt: $model->email_verified_at ? 
                DateTime::createFromInterface($model->email_verified_at) : null,
            createdAt: $model->created_at ? 
                DateTime::createFromInterface($model->created_at) : null,
            updatedAt: $model->updated_at ? 
                DateTime::createFromInterface($model->updated_at) : null
        );
    }
}

