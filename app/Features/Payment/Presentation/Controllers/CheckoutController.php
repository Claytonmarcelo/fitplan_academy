<?php

namespace App\Features\Payment\Presentation\Controllers;

use App\Features\Plan\Infrastructure\Models\Plan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Controller de Checkout
 * 
 * Gerencia o processo de pagamento
 */
class CheckoutController extends Controller
{
    /**
     * Exibe a página de checkout
     */
    public function show($planId)
    {
        $plan = Plan::findOrFail($planId);
        
        return view('checkout', compact('plan'));
    }

    /**
     * Processa o pagamento
     */
    public function process(Request $request, $planId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'card_number' => 'required|string',
            'card_expiry' => 'required|string',
            'card_cvv' => 'required|string|size:3',
        ]);

        $plan = Plan::findOrFail($planId);

        // Aqui você implementaria a integração com gateway de pagamento
        // Por enquanto, vamos simular um pagamento aprovado

        // Redireciona para página de sucesso
        return redirect()->route('checkout.success', $planId);
    }

    /**
     * Página de sucesso após pagamento
     */
    public function success($planId)
    {
        $plan = Plan::findOrFail($planId);
        
        return view('checkout-success', compact('plan'));
    }
}

