<?php

namespace App\Features\Success\Infrastructure\Repositories;

use App\Features\Success\Domain\Entities\SuccessEntity;
use App\Features\Success\Domain\Repositories\SuccessRepositoryInterface;
use App\Features\Checkout\Infrastructure\Models\Checkout;
use App\Features\Plan\Infrastructure\Models\Plan;
use App\Shared\Exceptions\NotFoundException;

/**
 * Implementação do repositório Success usando Eloquent
 * 
 * Gerencia as operações de dados da feature Success
 * Seguindo o padrão Repository para desacoplamento
 * 
 * @package App\Features\Success\Infrastructure\Repositories
 * @author FitPlan Academy Team
 * @version 1.0.0
 */
class SuccessRepository implements SuccessRepositoryInterface
{
    /**
     * Busca dados de success por ID do checkout
     * 
     * @param int $checkoutId
     * @return SuccessEntity|null
     */
    public function findByCheckoutId(int $checkoutId): ?SuccessEntity
    {
        $checkout = Checkout::with('plan')->find($checkoutId);
        
        if (!$checkout) {
            return null;
        }
        
        return $this->toEntity($checkout);
    }

    /**
     * Busca dados de success por ID do plano
     * 
     * @param int $planId
     * @return SuccessEntity|null
     */
    public function findByPlanId(int $planId): ?SuccessEntity
    {
        $plan = Plan::find($planId);
        
        if (!$plan) {
            return null;
        }
        
        // Buscar checkout mais recente para este plano
        $checkout = Checkout::where('plan_id', $planId)
            ->where('status', 'completed')
            ->latest()
            ->first();
            
        if (!$checkout) {
            return null;
        }
        
        return $this->toEntity($checkout);
    }

    /**
     * Cria um novo registro de success
     * 
     * @param SuccessEntity $success
     * @return SuccessEntity
     */
    public function create(SuccessEntity $success): SuccessEntity
    {
        // Por enquanto, não precisamos criar registros específicos de success
        // Os dados vêm do checkout e plano existentes
        return $success;
    }

    /**
     * Converte modelo Eloquent para Entity
     * 
     * @param Checkout $checkout
     * @return SuccessEntity
     */
    private function toEntity(Checkout $checkout): SuccessEntity
    {
        return new SuccessEntity(
            checkoutId: $checkout->id,
            planId: $checkout->plan_id,
            planName: $checkout->plan->name,
            planPrice: $checkout->plan->price,
            userName: $this->extractUserName($checkout->email),
            userEmail: $checkout->email,
            transactionId: $checkout->transaction_id ?? 'N/A',
            status: $checkout->status,
            createdAt: $checkout->created_at,
            nextSteps: 'Acesse sua conta para começar a usar o plano.',
            supportEmail: 'suporte@fitplan.com'
        );
    }

    /**
     * Extrai nome do usuário do email
     * 
     * @param string $email
     * @return string
     */
    private function extractUserName(string $email): string
    {
        $name = explode('@', $email)[0];
        return ucfirst($name);
    }
}











