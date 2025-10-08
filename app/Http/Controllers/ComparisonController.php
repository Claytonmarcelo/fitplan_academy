<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller para gerenciar páginas de comparação de planos
 * 
 * Este controller é responsável por:
 * - Exibir comparação completa de planos
 * - Mostrar tabela de preços
 * - Listar benefícios e recursos inclusos
 * - Gerenciar dados de comparação
 * 
 * Arquitetura: Clean Architecture
 * - Separação de responsabilidades
 * - Código limpo e comentado
 * - Performance otimizada
 */
class ComparisonController extends Controller
{
    /**
     * Exibe a página de comparação completa
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $plans = $this->getPlansData();
        $features = $this->getFeaturesData();
        
        return view('comparison.index', compact('plans', 'features'));
    }

    /**
     * Exibe a página de preços
     * 
     * @return \Illuminate\View\View
     */
    public function prices()
    {
        $plans = $this->getPlansData();
        $pricing = $this->getPricingData();
        
        return view('comparison.prices', compact('plans', 'pricing'));
    }

    /**
     * Exibe a página de benefícios
     * 
     * @return \Illuminate\View\View
     */
    public function benefits()
    {
        $plans = $this->getPlansData();
        $benefits = $this->getBenefitsData();
        
        return view('comparison.benefits', compact('plans', 'benefits'));
    }

    /**
     * Obtém dados dos planos
     * 
     * @return array
     */
    private function getPlansData()
    {
        return [
            [
                'id' => 'basic',
                'name' => 'Basic',
                'price' => 89.90,
                'description' => 'Plano essencial para iniciantes',
                'color' => 'zinc',
                'popular' => false,
            ],
            [
                'id' => 'smart',
                'name' => 'Smart',
                'price' => 149.90,
                'description' => 'Plano completo com personal trainer',
                'color' => 'orange',
                'popular' => true,
            ],
            [
                'id' => 'black',
                'name' => 'Black',
                'price' => 299.90,
                'description' => 'Plano premium com instalações exclusivas',
                'color' => 'black',
                'popular' => false,
            ],
        ];
    }

    /**
     * Obtém dados das funcionalidades para comparação
     * 
     * @return array
     */
    private function getFeaturesData()
    {
        return [
            [
                'name' => 'Acesso à Academia',
                'description' => 'Acesso completo às instalações',
                'basic' => true,
                'smart' => true,
                'black' => true,
            ],
            [
                'name' => 'Aulas em Grupo',
                'description' => 'Participação em aulas coletivas',
                'basic' => true,
                'smart' => true,
                'black' => true,
            ],
            [
                'name' => 'Personal Trainer',
                'description' => 'Sessões individuais com personal',
                'basic' => false,
                'smart' => true,
                'black' => true,
            ],
            [
                'name' => 'Planos Nutricionais',
                'description' => 'Consultoria nutricional personalizada',
                'basic' => false,
                'smart' => true,
                'black' => true,
            ],
            [
                'name' => 'Instalações Premium',
                'description' => 'Acesso a áreas exclusivas',
                'basic' => false,
                'smart' => false,
                'black' => true,
            ],
            [
                'name' => 'Spa e Relaxamento',
                'description' => 'Acesso a spa e área de relaxamento',
                'basic' => false,
                'smart' => false,
                'black' => true,
            ],
            [
                'name' => 'Piscina',
                'description' => 'Acesso à piscina aquecida',
                'basic' => false,
                'smart' => false,
                'black' => true,
            ],
            [
                'name' => 'Sauna',
                'description' => 'Acesso à sauna',
                'basic' => false,
                'smart' => false,
                'black' => true,
            ],
            [
                'name' => 'Estacionamento',
                'description' => 'Vaga de estacionamento inclusa',
                'basic' => false,
                'smart' => true,
                'black' => true,
            ],
            [
                'name' => 'App Mobile',
                'description' => 'Aplicativo móvel completo',
                'basic' => true,
                'smart' => true,
                'black' => true,
            ],
            [
                'name' => 'Suporte 24/7',
                'description' => 'Atendimento 24 horas por dia',
                'basic' => false,
                'smart' => true,
                'black' => true,
            ],
            [
                'name' => 'Convidados',
                'description' => 'Pode levar convidados',
                'basic' => false,
                'smart' => false,
                'black' => true,
            ],
        ];
    }

    /**
     * Obtém dados de preços detalhados
     * 
     * @return array
     */
    private function getPricingData()
    {
        return [
            'monthly' => [
                'basic' => 89.90,
                'smart' => 149.90,
                'black' => 299.90,
            ],
            'quarterly' => [
                'basic' => 249.90, // 3 meses com desconto
                'smart' => 399.90,
                'black' => 799.90,
            ],
            'annual' => [
                'basic' => 899.90, // 12 meses com desconto
                'smart' => 1499.90,
                'black' => 2999.90,
            ],
            'promotions' => [
                [
                    'plan' => 'smart',
                    'title' => 'Desconto de Lançamento',
                    'description' => 'Primeiro mês por apenas R$ 99,90',
                    'discount' => 50.00,
                    'valid_until' => '31/12/2025',
                ],
                [
                    'plan' => 'black',
                    'title' => 'Pacote Anual',
                    'description' => '2 meses grátis no plano anual',
                    'discount' => 599.80,
                    'valid_until' => '31/12/2025',
                ],
            ],
        ];
    }

    /**
     * Obtém dados detalhados dos benefícios
     * 
     * @return array
     */
    private function getBenefitsData()
    {
        return [
            'basic' => [
                [
                    'name' => 'Acesso à Academia',
                    'description' => 'Acesso completo às instalações básicas',
                    'icon' => '🏋️‍♂️',
                ],
                [
                    'name' => 'Aulas em Grupo',
                    'description' => 'Participação em todas as aulas coletivas',
                    'icon' => '👥',
                ],
                [
                    'name' => 'App Mobile',
                    'description' => 'Aplicativo móvel para acompanhar treinos',
                    'icon' => '📱',
                ],
                [
                    'name' => 'Horário Flexível',
                    'description' => 'Acesso nos horários de funcionamento',
                    'icon' => '⏰',
                ],
            ],
            'smart' => [
                [
                    'name' => 'Tudo do Basic',
                    'description' => 'Todos os benefícios do plano Basic',
                    'icon' => '✅',
                ],
                [
                    'name' => 'Personal Trainer',
                    'description' => '4 sessões mensais com personal trainer',
                    'icon' => '👨‍💼',
                ],
                [
                    'name' => 'Planos Nutricionais',
                    'description' => 'Consultoria nutricional personalizada',
                    'icon' => '🥗',
                ],
                [
                    'name' => 'Estacionamento',
                    'description' => 'Vaga de estacionamento inclusa',
                    'icon' => '🚗',
                ],
                [
                    'name' => 'Suporte 24/7',
                    'description' => 'Atendimento 24 horas por dia',
                    'icon' => '🆘',
                ],
                [
                    'name' => 'Avaliação Física',
                    'description' => 'Avaliação física mensal gratuita',
                    'icon' => '📊',
                ],
            ],
            'black' => [
                [
                    'name' => 'Tudo do Smart',
                    'description' => 'Todos os benefícios do plano Smart',
                    'icon' => '✅',
                ],
                [
                    'name' => 'Instalações Premium',
                    'description' => 'Acesso a áreas exclusivas e VIP',
                    'icon' => '👑',
                ],
                [
                    'name' => 'Spa e Relaxamento',
                    'description' => 'Acesso completo ao spa e área de relaxamento',
                    'icon' => '🧘‍♀️',
                ],
                [
                    'name' => 'Piscina Aquecida',
                    'description' => 'Acesso à piscina semi-olímpica aquecida',
                    'icon' => '🏊‍♂️',
                ],
                [
                    'name' => 'Sauna',
                    'description' => 'Acesso à sauna seca e úmida',
                    'icon' => '🔥',
                ],
                [
                    'name' => 'Convidados',
                    'description' => 'Pode levar até 2 convidados por mês',
                    'icon' => '👫',
                ],
                [
                    'name' => 'Personal Trainer Exclusivo',
                    'description' => 'Personal trainer dedicado',
                    'icon' => '👨‍💼',
                ],
                [
                    'name' => 'Nutricionista Exclusivo',
                    'description' => 'Nutricionista dedicado',
                    'icon' => '👩‍⚕️',
                ],
            ],
        ];
    }
}
