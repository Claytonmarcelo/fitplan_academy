<?php

namespace App\Features\Success\Domain\Repositories;

use App\Features\Success\Domain\Entities\SuccessEntity;

/**
 * Interface do repositório para Success
 * 
 * Define o contrato para operações de dados da feature Success
 * Seguindo o padrão Repository para desacoplamento
 * 
 * @package App\Features\Success\Domain\Repositories
 * @author FitPlan Academy Team
 * @version 1.0.0
 */
interface SuccessRepositoryInterface
{
    /**
     * Busca dados de success por ID do checkout
     * 
     * @param int $checkoutId ID do checkout
     * @return SuccessEntity|null
     */
    public function findByCheckoutId(int $checkoutId): ?SuccessEntity;

    /**
     * Busca dados de success por ID do plano
     * 
     * @param int $planId ID do plano
     * @return SuccessEntity|null
     */
    public function findByPlanId(int $planId): ?SuccessEntity;

    /**
     * Cria um novo registro de success
     * 
     * @param SuccessEntity $success
     * @return SuccessEntity
     */
    public function create(SuccessEntity $success): SuccessEntity;
}









