<?php

namespace App\Features\Success\Domain\Entities;

/**
 * Entidade de domínio para Success
 * 
 * Representa os dados de uma página de sucesso após checkout
 * 
 * @package App\Features\Success\Domain\Entities
 * @author FitPlan Academy Team
 * @version 1.0.0
 */
class SuccessEntity
{
    public function __construct(
        public readonly int $checkoutId,
        public readonly int $planId,
        public readonly string $planName,
        public readonly float $planPrice,
        public readonly string $userName,
        public readonly string $userEmail,
        public readonly string $transactionId,
        public readonly string $status,
        public readonly \DateTimeImmutable $createdAt,
        public readonly ?string $nextSteps = null,
        public readonly ?string $supportEmail = null
    ) {}

    /**
     * Verifica se o success está em estado válido
     */
    public function isValid(): bool
    {
        return !empty($this->checkoutId) 
            && !empty($this->planId)
            && !empty($this->userName)
            && !empty($this->userEmail)
            && !empty($this->status);
    }

    /**
     * Retorna o valor formatado do plano
     */
    public function getFormattedPrice(): string
    {
        return 'R$ ' . number_format($this->planPrice, 2, ',', '.');
    }

    /**
     * Retorna a data formatada
     */
    public function getFormattedDate(): string
    {
        return $this->createdAt->format('d/m/Y H:i');
    }
}









