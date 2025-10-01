<?php

namespace App\Features\Checkout\Application\UseCases;

use App\Features\Checkout\Application\DTOs\CreateCheckoutDTO;
use App\Features\Checkout\Application\DTOs\CheckoutResponseDTO;
use App\Features\Checkout\Domain\Entities\CheckoutEntity;
use App\Features\Checkout\Domain\Repositories\CheckoutRepositoryInterface;
use App\Features\Plan\Infrastructure\Models\Plan;
use App\Features\User\Infrastructure\Models\User;
use App\Shared\Exceptions\BusinessException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

/**
 * Use Case para processar checkout
 * 
 * Gerencia todo o fluxo de checkout incluindo:
 * - Validação de dados
 * - Criação/atualização de usuário
 * - Processamento de pagamento
 * - Criação de assinatura
 */
class ProcessCheckoutUseCase
{
    public function __construct(
        private CheckoutRepositoryInterface $checkoutRepository
    ) {}

    /**
     * Executa o processamento completo do checkout
     */
    public function execute(CreateCheckoutDTO $checkoutData): CheckoutResponseDTO
    {
        try {
            DB::beginTransaction();

            // 1. Validar dados do checkout
            $this->validateCheckoutData($checkoutData);

            // 2. Verificar se o plano existe
            $plan = $this->getPlan($checkoutData->planId);

            // 3. Criar ou atualizar usuário
            $user = $this->createOrUpdateUser($checkoutData);

            // 4. Processar pagamento
            $paymentResult = $this->processPayment($checkoutData);

            // 5. Criar checkout
            $checkout = $this->createCheckout($checkoutData, $paymentResult['transaction_id']);

            // 6. Criar assinatura
            $this->createSubscription($user, $plan, $checkout);

            DB::commit();

            return CheckoutResponseDTO::success(
                message: 'Checkout processado com sucesso!',
                checkoutId: $checkout->id,
                redirectUrl: route('checkout.success', ['plan' => $checkoutData->planId, 'checkout' => $checkout->id]),
                transactionId: $paymentResult['transaction_id']
            );

        } catch (\Exception $e) {
            DB::rollBack();
            
            return CheckoutResponseDTO::error(
                message: 'Erro ao processar checkout: ' . $e->getMessage(),
                errors: ['checkout' => [$e->getMessage()]]
            );
        }
    }

    /**
     * Valida os dados do checkout
     */
    private function validateCheckoutData(CreateCheckoutDTO $checkoutData): void
    {
        if (!$checkoutData->isValid()) {
            throw new BusinessException('Dados do checkout inválidos');
        }

        // Validações específicas
        if (!filter_var($checkoutData->email, FILTER_VALIDATE_EMAIL)) {
            throw new BusinessException('Email inválido');
        }

        if (empty($checkoutData->firstName) || empty($checkoutData->lastName)) {
            throw new BusinessException('Nome e sobrenome são obrigatórios');
        }

        if (!preg_match('/^\d{4}\s?\d{4}\s?\d{4}\s?\d{4}$/', $checkoutData->cardNumber)) {
            throw new BusinessException('Número do cartão inválido');
        }

        if (!preg_match('/^\d{3,4}$/', $checkoutData->cvc)) {
            throw new BusinessException('CVC inválido');
        }
    }

    /**
     * Busca o plano pelo ID
     */
    private function getPlan(int $planId): Plan
    {
        $plan = Plan::find($planId);
        
        if (!$plan) {
            throw new BusinessException('Plano não encontrado');
        }

        if (!$plan->is_active) {
            throw new BusinessException('Plano não está ativo');
        }

        return $plan;
    }

    /**
     * Cria ou atualiza usuário
     */
    private function createOrUpdateUser(CreateCheckoutDTO $checkoutData): User
    {
        $user = User::where('email', $checkoutData->email)->first();

        if ($user) {
            // Atualizar dados do usuário
            $user->update([
                'name' => $checkoutData->firstName . ' ' . $checkoutData->lastName,
                'phone' => $checkoutData->phone
            ]);
        } else {
            // Criar novo usuário
            $user = User::create([
                'name' => $checkoutData->firstName . ' ' . $checkoutData->lastName,
                'email' => $checkoutData->email,
                'phone' => $checkoutData->phone,
                'password' => Hash::make('temp_password_' . time()), // Senha temporária
                'email_verified_at' => now()
            ]);
        }

        return $user;
    }

    /**
     * Processa o pagamento (simulado)
     */
    private function processPayment(CreateCheckoutDTO $checkoutData): array
    {
        // Aqui você integraria com um gateway de pagamento real
        // Por enquanto, simulamos um pagamento bem-sucedido
        
        $transactionId = 'TXN_' . time() . '_' . rand(1000, 9999);
        
        // Simular processamento
        sleep(1);
        
        return [
            'transaction_id' => $transactionId,
            'status' => 'completed',
            'amount' => $checkoutData->total
        ];
    }

    /**
     * Cria o checkout
     */
    private function createCheckout(CreateCheckoutDTO $checkoutData, string $transactionId): CheckoutEntity
    {
        $checkout = new CheckoutEntity(
            planId: $checkoutData->planId,
            email: $checkoutData->email,
            password: $checkoutData->password,
            cardName: $checkoutData->cardName,
            cardNumber: $checkoutData->cardNumber,
            expiryDate: $checkoutData->expiryDate,
            cvc: $checkoutData->cvc,
            zipCode: $checkoutData->zipCode,
            subtotal: $checkoutData->subtotal,
            taxes: $checkoutData->taxes,
            total: $checkoutData->total,
            status: 'completed'
        );

        return $this->checkoutRepository->save($checkout);
    }

    /**
     * Cria a assinatura do usuário
     */
    private function createSubscription(User $user, Plan $plan, CheckoutEntity $checkout): void
    {
        $user->subscriptions()->create([
            'plan_id' => $plan->id,
            'checkout_id' => $checkout->id,
            'status' => 'active',
            'starts_at' => now(),
            'ends_at' => now()->addMonth(),
            'amount' => $checkout->total
        ]);
    }
}
