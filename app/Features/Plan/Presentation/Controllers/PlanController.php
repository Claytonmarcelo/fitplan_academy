<?php

namespace App\Features\Plan\Presentation\Controllers;

use App\Features\Plan\Infrastructure\Models\Plan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Controller de Planos
 * 
 * Gerencia a exibição de planos e landing page
 */
class PlanController extends Controller
{
    /**
     * Exibe a landing page com os planos
     */
    public function landing()
    {
        // Planos hardcoded para demonstração (pode ser movido para banco depois)
        $plans = collect([
            (object) [
                'id' => 1,
                'name' => 'Basic',
                'description' => 'Ideal para iniciantes',
                'price' => 79.90,
                'features' => [
                    'Acesso a equipamentos básicos',
                    'Treino livre',
                    'Vestiário com armários',
                    'Horário: 6h às 22h'
                ]
            ],
            (object) [
                'id' => 2,
                'name' => 'Smart',
                'description' => 'Mais popular entre nossos alunos',
                'price' => 129.90,
                'features' => [
                    'Todos os benefícios do Basic',
                    'Aulas coletivas incluídas',
                    'Avaliação física trimestral',
                    'App de treinos personalizado',
                    'Horário: 5h às 23h'
                ]
            ],
            (object) [
                'id' => 3,
                'name' => 'Black',
                'description' => 'Premium e completo',
                'price' => 199.90,
                'features' => [
                    'Todos os benefícios do Smart',
                    'Personal trainer 2x por mês',
                    'Nutricionista incluso',
                    'Acesso a todas as unidades',
                    'Acesso 24 horas',
                    'Sala VIP',
                    'Convidados ilimitados'
                ]
            ]
        ]);
        
        return view('landing', compact('plans'));
    }

    /**
     * Exibe uma página específica de um plano
     */
    public function show(Request $request)
    {
        $planName = $request->route('plan_name', 'Basic');
        
        // Buscar o plano específico
        $plans = collect([
            (object) [
                'id' => 1,
                'name' => 'Basic',
                'description' => 'Ideal para iniciantes',
                'price' => 79.90,
                'features' => [
                    'Acesso a equipamentos básicos',
                    'Treino livre',
                    'Vestiário com armários',
                    'Horário: 6h às 22h',
                    'Água e toalhas inclusas',
                    'Suporte da equipe'
                ],
                'benefits' => [
                    'Entrada livre fora do horário de pico',
                    'Acesso a todas as máquinas de musculação',
                    'Área de cardio completa',
                    'Treinos básicos inclusos'
                ]
            ],
            (object) [
                'id' => 2,
                'name' => 'Smart',
                'description' => 'Mais popular entre nossos alunos',
                'price' => 129.90,
                'features' => [
                    'Todos os benefícios do Basic',
                    'Aulas coletivas incluídas',
                    'Avaliação física trimestral',
                    'App de treinos personalizado',
                    'Horário: 5h às 23h',
                    'Acesso a área de alongamento premium',
                    'Suporte nutricional básico'
                ],
                'benefits' => [
                    '50+ aulas coletivas por semana',
                    'Treinos personalizados no app',
                    'Acompanhamento de progresso',
                    'Desconto em produtos da loja'
                ]
            ],
            (object) [
                'id' => 3,
                'name' => 'Black',
                'description' => 'Premium e completo',
                'price' => 199.90,
                'features' => [
                    'Todos os benefícios do Smart',
                    'Personal trainer 2x por mês',
                    'Nutricionista incluso',
                    'Acesso a todas as unidades',
                    'Acesso 24 horas',
                    'Sala VIP',
                    'Convidados ilimitados',
                    'Massagem terapêutica mensal',
                    'Suplementação básica inclusa'
                ],
                'benefits' => [
                    'Atendimento personalizado prioritário',
                    'Acesso a todas as unidades da rede',
                    'Horário de funcionamento estendido',
                    'Benefícios exclusivos VIP',
                    'Consultoria nutricional individual'
                ]
            ]
        ]);
        
        $currentPlan = $plans->firstWhere('name', $planName);
        
        if (!$currentPlan) {
            abort(404, 'Plano não encontrado');
        }
        
        return view('plans.show', compact('currentPlan', 'plans'));
    }

    /**
     * Lista todos os planos (API)
     */
    public function index()
    {
        $plans = Plan::active()->get();
        
        return response()->json([
            'data' => $plans
        ]);
    }
}

