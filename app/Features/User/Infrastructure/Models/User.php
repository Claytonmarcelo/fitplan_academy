<?php

namespace App\Features\User\Infrastructure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Model Eloquent - User
 * 
 * Model do Eloquent ORM para interação com o banco de dados PostgreSQL.
 * Esta classe pertence à camada de infraestrutura.
 * 
 * Performance Tips:
 * - Índices são definidos na migration
 * - Relacionamentos são lazy-loaded por padrão
 * - Use eager loading quando necessário
 * 
 * @package App\Features\User\Infrastructure\Models
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Nome da tabela no PostgreSQL
     * 
     * @var string
     */
    protected $table = 'users';

    /**
     * Atributos que podem ser preenchidos em massa
     * 
     * IMPORTANTE: Nunca adicione campos sensíveis aqui sem validação adequada
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'email_verified_at',
    ];

    /**
     * Atributos que devem ser ocultados em arrays/JSON
     * 
     * SEGURANÇA: Password nunca deve ser exposto
     * 
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting de atributos para tipos específicos
     * 
     * Performance: Evita conversões manuais
     * 
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Atributos que devem ser tratados como datas
     * 
     * @var array<int, string>
     */
    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
    ];

    /**
     * Boot do model - eventos e observers
     * 
     * Performance: Use observers para lógica complexa
     */
    protected static function boot()
    {
        parent::boot();

        // Exemplo: Hash automático de senha ao criar/atualizar
        static::saving(function ($user) {
            // A senha já deve vir hasheada do use case
            // Este é apenas um exemplo de uso do boot
        });
    }

    /**
     * Scope para buscar apenas usuários ativos
     * 
     * Uso: User::active()->get()
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para buscar usuários inativos
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    /**
     * Verifica se o usuário está ativo
     * 
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }
}

