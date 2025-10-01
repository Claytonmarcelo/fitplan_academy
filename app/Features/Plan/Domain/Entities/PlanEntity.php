<?php

namespace App\Features\Plan\Domain\Entities;

use DateTime;

/**
 * Entidade de Domínio - Plan
 * 
 * Representa um plano de assinatura no sistema.
 * 
 * @package App\Features\Plan\Domain\Entities
 */
class PlanEntity
{
    /**
     * @param int|null $id
     * @param string $name Nome do plano (Basic, Smart, Black)
     * @param string $description Descrição do plano
     * @param float $price Preço mensal
     * @param array $features Lista de funcionalidades
     * @param bool $isActive Se o plano está ativo
     * @param DateTime|null $createdAt
     * @param DateTime|null $updatedAt
     */
    public function __construct(
        private ?int $id,
        private string $name,
        private string $description,
        private float $price,
        private array $features,
        private bool $isActive = true,
        private ?DateTime $createdAt = null,
        private ?DateTime $updatedAt = null
    ) {
        $this->validatePrice($price);
    }

    private function validatePrice(float $price): void
    {
        if ($price < 0) {
            throw new \InvalidArgumentException('O preço não pode ser negativo');
        }
    }

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getDescription(): string { return $this->description; }
    public function getPrice(): float { return $this->price; }
    public function getFeatures(): array { return $this->features; }
    public function isActive(): bool { return $this->isActive; }
    public function getCreatedAt(): ?DateTime { return $this->createdAt; }
    public function getUpdatedAt(): ?DateTime { return $this->updatedAt; }

    // Métodos de negócio
    public function activate(): void { $this->isActive = true; }
    public function deactivate(): void { $this->isActive = false; }
}

