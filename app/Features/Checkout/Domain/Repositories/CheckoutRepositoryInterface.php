<?php

namespace App\Features\Checkout\Domain\Repositories;

use App\Features\Checkout\Domain\Entities\CheckoutEntity;

/**
 * Interface do Repositório de Checkout
 * 
 * Define os contratos para persistência de dados de checkout
 */
interface CheckoutRepositoryInterface
{
    /**
     * Salva um novo checkout
     */
    public function save(CheckoutEntity $checkout): CheckoutEntity;

    /**
     * Busca um checkout por ID
     */
    public function findById(int $id): ?CheckoutEntity;

    /**
     * Busca um checkout por email
     */
    public function findByEmail(string $email): ?CheckoutEntity;

    /**
     * Atualiza um checkout existente
     */
    public function update(CheckoutEntity $checkout): CheckoutEntity;

    /**
     * Remove um checkout
     */
    public function delete(int $id): bool;

    /**
     * Lista checkouts por status
     */
    public function findByStatus(string $status): array;

    /**
     * Lista checkouts por plano
     */
    public function findByPlanId(int $planId): array;
}


