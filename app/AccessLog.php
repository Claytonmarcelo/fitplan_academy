<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Features\User\Infrastructure\Models\User;

/**
 * AccessLog Model
 * 
 * Modelo para gerenciar logs de acesso do sistema.
 * Armazena dados de auditoria e controle de acessos.
 */
class AccessLog extends Model
{
    use HasFactory;

    /**
     * Nome da tabela
     */
    protected $table = 'access_logs';

    /**
     * Campos que podem ser preenchidos em massa
     */
    protected $fillable = [
        'user_id',
        'user_name',
        'user_cpf',
        'user_login',
        'ip_address',
        'user_agent',
        'two_factor_used',
        'login_successful',
    ];

    /**
     * Casting de atributos
     */
    protected $casts = [
        'two_factor_used' => 'boolean',
        'login_successful' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relacionamento com usuário
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope para logs de hoje
     */
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    /**
     * Scope para logs bem-sucedidos
     */
    public function scopeSuccessful($query)
    {
        return $query->where('login_successful', true);
    }

    /**
     * Scope para logs com falha
     */
    public function scopeFailed($query)
    {
        return $query->where('login_successful', false);
    }
}
