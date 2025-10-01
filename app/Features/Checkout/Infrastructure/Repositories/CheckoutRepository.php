<?php

namespace App\Features\Checkout\Infrastructure\Repositories;

use App\Features\Checkout\Domain\Entities\CheckoutEntity;
use App\Features\Checkout\Domain\Repositories\CheckoutRepositoryInterface;
use App\Features\Checkout\Infrastructure\Models\Checkout;

/**
 * Implementação do Repositório de Checkout
 * 
 * Gerencia a persistência de dados de checkout usando Eloquent
 */
class CheckoutRepository implements CheckoutRepositoryInterface
{
    public function save(CheckoutEntity $checkout): CheckoutEntity
    {
        $model = new Checkout([
            'plan_id' => $checkout->planId,
            'email' => $checkout->email,
            'password' => $checkout->password,
            'card_name' => $checkout->cardName,
            'card_number' => $checkout->cardNumber,
            'expiry_date' => $checkout->expiryDate,
            'cvc' => $checkout->cvc,
            'zip_code' => $checkout->zipCode,
            'subtotal' => $checkout->subtotal,
            'taxes' => $checkout->taxes,
            'total' => $checkout->total,
            'status' => $checkout->status ?? 'pending'
        ]);

        $model->save();

        return $this->toEntity($model);
    }

    public function findById(int $id): ?CheckoutEntity
    {
        $model = Checkout::find($id);
        
        return $model ? $this->toEntity($model) : null;
    }

    public function findByEmail(string $email): ?CheckoutEntity
    {
        $model = Checkout::byEmail($email)->first();
        
        return $model ? $this->toEntity($model) : null;
    }

    public function update(CheckoutEntity $checkout): CheckoutEntity
    {
        $model = Checkout::findOrFail($checkout->id);
        
        $model->update([
            'plan_id' => $checkout->planId,
            'email' => $checkout->email,
            'password' => $checkout->password,
            'card_name' => $checkout->cardName,
            'card_number' => $checkout->cardNumber,
            'expiry_date' => $checkout->expiryDate,
            'cvc' => $checkout->cvc,
            'zip_code' => $checkout->zipCode,
            'subtotal' => $checkout->subtotal,
            'taxes' => $checkout->taxes,
            'total' => $checkout->total,
            'status' => $checkout->status
        ]);

        return $this->toEntity($model->fresh());
    }

    public function delete(int $id): bool
    {
        return Checkout::destroy($id) > 0;
    }

    public function findByStatus(string $status): array
    {
        $models = Checkout::byStatus($status)->get();
        
        return $models->map(fn($model) => $this->toEntity($model))->toArray();
    }

    public function findByPlanId(int $planId): array
    {
        $models = Checkout::byPlan($planId)->get();
        
        return $models->map(fn($model) => $this->toEntity($model))->toArray();
    }

    /**
     * Converte model Eloquent para Entity
     */
    private function toEntity(Checkout $model): CheckoutEntity
    {
        return new CheckoutEntity(
            planId: $model->plan_id,
            email: $model->email,
            password: $model->password,
            cardName: $model->card_name,
            cardNumber: $model->card_number,
            expiryDate: $model->expiry_date,
            cvc: $model->cvc,
            zipCode: $model->zip_code,
            subtotal: $model->subtotal,
            taxes: $model->taxes,
            total: $model->total,
            id: $model->id,
            status: $model->status,
            createdAt: $model->created_at,
            updatedAt: $model->updated_at
        );
    }
}
