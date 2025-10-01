<?php

namespace App\Features\Success\Presentation\Controllers;

use App\Features\Success\Application\UseCases\GetSuccessDataUseCase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Controller para a feature Success
 * 
 * Gerencia a exibição da página de sucesso após checkout
 * Seguindo os princípios de Clean Architecture
 * 
 * @package App\Features\Success\Presentation\Controllers
 * @author FitPlan Academy Team
 * @version 1.0.0
 */
class SuccessController extends Controller
{
    public function __construct(
        private GetSuccessDataUseCase $getSuccessDataUseCase
    ) {}

    /**
     * Exibe a página de sucesso
     * 
     * @param Request $request
     * @param int $planId ID do plano
     * @param int $checkoutId ID do checkout
     * @return View|RedirectResponse
     */
    public function show(Request $request, int $planId, int $checkoutId): View|RedirectResponse
    {
        try {
            // Validar parâmetros
            if ($planId <= 0 || $checkoutId <= 0) {
                return redirect()->route('landing')->with('error', 'Parâmetros inválidos.');
            }

            // Obter dados de sucesso
            $successData = $this->getSuccessDataUseCase->execute($checkoutId);
            
            // Se não foi sucesso, redirecionar com erro
            if (!$successData->success) {
                return redirect()->route('landing')->with('error', $successData->message);
            }

            // Renderizar view com dados
            return view('success', [
                'success' => $successData->toArray(),
                'page_title' => 'Sucesso - FitPlan Academy',
                'meta_description' => 'Sua inscrição foi realizada com sucesso. Bem-vindo à FitPlan Academy!'
            ]);

        } catch (\Exception $e) {
            // Log do erro
            \Log::error('Erro na página de sucesso', [
                'plan_id' => $planId,
                'checkout_id' => $checkoutId,
                'error' => $e->getMessage(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            // Redirecionar para landing com erro genérico
            return redirect()->route('landing')->with('error', 
                'Ocorreu um erro ao processar sua solicitação. Entre em contato com o suporte.'
            );
        }
    }

    /**
     * Redireciona para a conta do usuário
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function goToAccount(Request $request): RedirectResponse
    {
        // Por enquanto, redireciona para dashboard
        // Futuramente pode implementar login automático
        return redirect()->route('dashboard');
    }

    /**
     * Exibe página de contato com suporte
     * 
     * @param Request $request
     * @return View
     */
    public function support(Request $request): View
    {
        return view('support', [
            'page_title' => 'Suporte - FitPlan Academy',
            'support_email' => 'suporte@fitplan.com',
            'contact_phone' => '(11) 99999-9999'
        ]);
    }
}
