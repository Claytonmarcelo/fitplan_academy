<?php

namespace App\Features\Checkout\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model Eloquent para Checkout
 * 
 * Representa a tabela de checkouts no banco de dados
 */
class Checkout extends Model
{
    protected $table = 'checkouts';

    protected $fillable = [
        'plan_id',
        'email',
        'password',
        'payment_method',
        'card_name',
        'card_number',
        'expiry_date',
        'cvc',
        'zip_code',
        'subtotal',
        'taxes',
        'total',
        'status',
        'transaction_id'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'taxes' => 'decimal:2',
        'total' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Relacionamento com plano
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(\App\Features\Plan\Infrastructure\Models\Plan::class);
    }

    /**
     * Relacionamento com assinaturas
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(\App\Features\Subscription\Infrastructure\Models\Subscription::class);
    }

    /**
     * Scope para checkouts por status
     */
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope para checkouts por plano
     */
    public function scopeByPlan($query, int $planId)
    {
        return $query->where('plan_id', $planId);
    }

    /**
     * Scope para checkouts por email
     */
    public function scopeByEmail($query, string $email)
    {
        return $query->where('email', $email);
    }

    /**
     * Verifica se o checkout está completo
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Verifica se o checkout falhou
     */
    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    /**
     * Verifica se o checkout está pendente
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }
}
