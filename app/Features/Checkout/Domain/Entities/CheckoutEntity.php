<?php

namespace App\Features\Checkout\Domain\Entities;

/**
 * Entidade de Checkout
 * 
 * Representa um processo de checkout com informações de pagamento
 */
class CheckoutEntity
{
    public function __construct(
        public readonly int $planId,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $email,
        public readonly string $phone,
        public readonly string $cardName,
        public readonly string $cardNumber,
        public readonly string $expiryDate,
        public readonly string $cvc,
        public readonly string $zipCode,
        public readonly float $subtotal,
        public readonly float $taxes,
        public readonly float $total,
        public readonly ?int $id = null,
        public readonly ?string $status = null,
        public readonly ?\DateTime $createdAt = null,
        public readonly ?\DateTime $updatedAt = null
    ) {}

    /**
     * Cria uma nova instância com dados atualizados
     */
    public function withStatus(string $status): self
    {
        return new self(
            planId: $this->planId,
            firstName: $this->firstName,
            lastName: $this->lastName,
            email: $this->email,
            phone: $this->phone,
            cardName: $this->cardName,
            cardNumber: $this->cardNumber,
            expiryDate: $this->expiryDate,
            cvc: $this->cvc,
            zipCode: $this->zipCode,
            subtotal: $this->subtotal,
            taxes: $this->taxes,
            total: $this->total,
            id: $this->id,
            status: $status,
            createdAt: $this->createdAt,
            updatedAt: new \DateTime()
        );
    }

    /**
     * Valida se o checkout está em um estado válido para processamento
     */
    public function canBeProcessed(): bool
    {
        return $this->status === null || $this->status === 'pending';
    }

    /**
     * Verifica se o checkout foi processado com sucesso
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
}
