<?php

namespace App\Features\Success\Application\UseCases;

use App\Features\Success\Application\DTOs\SuccessResponseDTO;
use App\Features\Success\Domain\Entities\SuccessEntity;
use App\Features\Success\Domain\Repositories\SuccessRepositoryInterface;
use App\Features\Checkout\Infrastructure\Models\Checkout;
use App\Features\Plan\Infrastructure\Models\Plan;
use App\Shared\Exceptions\NotFoundException;
use Illuminate\Support\Facades\DB;

/**
 * Use Case para obter dados da página de sucesso
 * 
 * Orquestra a busca de dados necessários para exibir a página de sucesso
 * Inclui validações de negócio e tratamento de erros
 * 
 * @package App\Features\Success\Application\UseCases
 * @author FitPlan Academy Team
 * @version 1.0.0
 */
class GetSuccessDataUseCase
{
    public function __construct(
        private SuccessRepositoryInterface $successRepository
    ) {}

    /**
     * Executa o caso de uso para obter dados de sucesso
     * 
     * @param int $checkoutId ID do checkout
     * @return SuccessResponseDTO
     * @throws NotFoundException
     */
    public function execute(int $checkoutId): SuccessResponseDTO
    {
        try {
            // 1. Buscar dados do checkout
            $checkout = $this->getCheckoutData($checkoutId);
            
            // 2. Buscar dados do plano
            $plan = $this->getPlanData($checkout->plan_id);
            
            // 3. Validar se o checkout está completo
            $this->validateCheckoutStatus($checkout);
            
            // 4. Criar DTO de resposta
            return $this->createSuccessResponse($checkout, $plan);
            
        } catch (\Exception $e) {
            // Log do erro para monitoramento
            \Log::error('Erro ao obter dados de sucesso', [
                'checkout_id' => $checkoutId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return SuccessResponseDTO::error(
                title: 'Erro ao carregar dados',
                message: 'Não foi possível carregar os dados da sua compra. Entre em contato com o suporte.'
            );
        }
    }

    /**
     * Busca dados do checkout
     * 
     * @param int $checkoutId
     * @return Checkout
     * @throws NotFoundException
     */
    private function getCheckoutData(int $checkoutId): Checkout
    {
        $checkout = Checkout::with('plan')->find($checkoutId);
        
        if (!$checkout) {
            throw new NotFoundException('Checkout não encontrado');
        }
        
        return $checkout;
    }

    /**
     * Busca dados do plano
     * 
     * @param int $planId
     * @return Plan
     * @throws NotFoundException
     */
    private function getPlanData(int $planId): Plan
    {
        $plan = Plan::find($planId);
        
        if (!$plan) {
            throw new NotFoundException('Plano não encontrado');
        }
        
        return $plan;
    }

    /**
     * Valida se o checkout está em status válido
     * 
     * @param Checkout $checkout
     * @throws \Exception
     */
    private function validateCheckoutStatus(Checkout $checkout): void
    {
        if ($checkout->status !== 'completed') {
            throw new \Exception('Checkout não foi completado com sucesso');
        }
    }

    /**
     * Cria a resposta de sucesso
     * 
     * @param Checkout $checkout
     * @param Plan $plan
     * @return SuccessResponseDTO
     */
    private function createSuccessResponse(Checkout $checkout, Plan $plan): SuccessResponseDTO
    {
        // Extrair nome do usuário do email (parte antes do @)
        $userName = explode('@', $checkout->email)[0];
        $userName = ucfirst($userName);
        
        return SuccessResponseDTO::success(
            title: 'Inscrição realizada com sucesso!',
            message: 'Bem-vindo à comunidade FitFlex. Sua conta está pronta.',
            userName: $userName,
            planName: $plan->name,
            formattedPrice: 'R$ ' . number_format($plan->price, 2, ',', '.'),
            transactionId: $checkout->transaction_id ?? 'N/A',
            formattedDate: $checkout->created_at->format('d/m/Y H:i'),
            nextSteps: 'Acesse sua conta para começar a usar o plano.',
            supportEmail: 'suporte@fitplan.com',
            accountUrl: '/dashboard',
            metadata: [
                'checkout_id' => $checkout->id,
                'plan_id' => $plan->id,
                'payment_method' => $checkout->payment_method,
                'created_at' => $checkout->created_at->toISOString()
            ]
        );
    }
}










