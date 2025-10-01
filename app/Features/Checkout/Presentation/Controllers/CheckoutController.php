<?php

namespace App\Features\Checkout\Presentation\Controllers;

use App\Features\Checkout\Application\DTOs\CreateCheckoutDTO;
use App\Features\Checkout\Application\UseCases\ProcessCheckoutUseCase;
use App\Features\Checkout\Infrastructure\Repositories\CheckoutRepository;
use App\Features\Checkout\Presentation\Requests\ProcessCheckoutRequest;
use App\Features\Plan\Infrastructure\Models\Plan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

/**
 * Controller de Checkout
 * 
 * Gerencia as operações relacionadas ao checkout
 */
class CheckoutController extends Controller
{
    public function __construct(
        private ProcessCheckoutUseCase $processCheckoutUseCase
    ) {}

    /**
     * Exibe a página de checkout
     */
    public function show(Request $request, int $planId): View
    {
        $plan = Plan::findOrFail($planId);
        
        // Calcular valores
        $subtotal = $plan->price;
        $taxes = 0; // Por enquanto sem impostos
        $total = $subtotal + $taxes;

        return view('checkout', compact('plan', 'subtotal', 'taxes', 'total'));
    }

    /**
     * Processa o checkout
     */
    public function process(ProcessCheckoutRequest $request, int $planId): JsonResponse
    {
        try {
            // Buscar plano
            $plan = Plan::findOrFail($planId);
            
            // Calcular valores
            $subtotal = $plan->price;
            $taxes = 0;
            $total = $subtotal + $taxes;

            // Criar DTO
            $checkoutData = new CreateCheckoutDTO(
                planId: $planId,
                firstName: $request->first_name,
                lastName: $request->last_name,
                email: $request->email,
                phone: $request->phone,
                cpf: $request->cpf,
                paymentMethod: $request->payment_method,
                cardName: $request->card_name,
                cardNumber: $request->card_number,
                expiryDate: $request->expiry_date,
                cvc: $request->cvc,
                zipCode: $request->zip_code,
                street: $request->street,
                neighborhood: $request->neighborhood,
                city: $request->city,
                state: $request->state,
                number: $request->number,
                complement: $request->complement,
                subtotal: $subtotal,
                taxes: $taxes,
                total: $total
            );

            // Processar checkout
            $result = $this->processCheckoutUseCase->execute($checkoutData);

                if ($result->success) {
                    return response()->json([
                        'success' => true,
                        'message' => $result->message,
                        'redirect_url' => route('obrigado', ['plan' => $planId, 'checkout' => $result->checkoutId]),
                        'checkout_id' => $result->checkoutId,
                        'transaction_id' => $result->transactionId
                    ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $result->message,
                    'errors' => $result->errors
                ], 422);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro interno do servidor: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Exibe a página de sucesso do checkout
     */
    public function success(Request $request, int $planId, int $checkoutId): View
    {
        // Aqui você pode buscar os dados do checkout para exibir
        // Por enquanto, vamos apenas exibir a página de sucesso
        
        return view('checkout-success', [
            'checkout_id' => $checkoutId,
            'plan_id' => $planId,
            'message' => 'Pagamento processado com sucesso!'
        ]);
    }
}
