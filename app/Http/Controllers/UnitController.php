<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller para gerenciar unidades da academia
 * 
 * Este controller é responsável por:
 * - Exibir lista de unidades
 * - Mostrar detalhes de unidades específicas
 * - Gerenciar informações das instalações
 * 
 * Arquitetura: Clean Architecture
 * - Separação de responsabilidades
 * - Código limpo e comentado
 * - Performance otimizada
 */
class UnitController extends Controller
{
    /**
     * Exibe a lista de todas as unidades
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $units = $this->getAllUnits();
        
        return view('units.index', compact('units'));
    }

    /**
     * Exibe detalhes de uma unidade específica
     * 
     * @param string $unitId
     * @return \Illuminate\View\View
     */
    public function show($unitId)
    {
        $unit = $this->getUnitDetails($unitId);
        
        if (!$unit) {
            abort(404, 'Unidade não encontrada');
        }
        
        // Obter outras unidades (excluindo a atual)
        $allUnits = $this->getAllUnits();
        $otherUnits = array_filter($allUnits, function($u) use ($unitId) {
            return $u['id'] !== $unitId;
        });
        
        return view('units.show', compact('unit', 'otherUnits'));
    }

    /**
     * Obtém todas as unidades da academia
     * 
     * @return array
     */
    private function getAllUnits()
    {
        return [
            [
                'id' => 'centro',
                'name' => 'FitPlan Centro',
                'description' => 'Nossa unidade principal no coração da cidade',
                'address' => 'Av. Paulista, 1000 - Bela Vista, São Paulo - SP',
                'image' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=800&h=600&fit=crop&crop=center',
                'features' => [
                    'Academia completa com equipamentos modernos',
                    'Salas de aula em grupo',
                    'Área de musculação e cardio',
                    'Estacionamento próprio',
                    'Vestiários com armários',
                    'Loja de suplementos'
                ],
                'equipment' => [
                    'Máquinas de musculação Life Fitness',
                    'Esteiras e bicicletas ergométricas',
                    'Equipamentos de CrossFit',
                    'Pesos livres e halteres',
                    'Máquinas de pilates',
                    'Espelhos e barras de ballet'
                ],
                'classes' => [
                    'Pilates Mat',
                    'Spinning',
                    'Yoga Flow',
                    'CrossFit',
                    'Zumba',
                    'Funcional'
                ],
                'operating_hours' => [
                    'Segunda a Sexta: 6h às 23h',
                    'Sábado: 7h às 21h',
                    'Domingo: 8h às 20h'
                ],
                'contact' => [
                    'phone' => '(11) 3456-7890',
                    'email' => 'centro@fitplan.com.br',
                    'whatsapp' => '(11) 99999-1234'
                ]
            ],
            [
                'id' => 'zona-sul',
                'name' => 'FitPlan Zona Sul',
                'description' => 'Unidade focada em aulas em grupo e pilates',
                'address' => 'Rua Augusta, 500 - Jardins, São Paulo - SP',
                'image' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=800&h=600&fit=crop&crop=center',
                'features' => [
                    'Foco em aulas em grupo',
                    'Estúdio de pilates completo',
                    'Sala de yoga climatizada',
                    'Área de musculação compacta',
                    'Café e lanchonete',
                    'Estacionamento rotativo'
                ],
                'equipment' => [
                    'Máquinas de pilates',
                    'Mats e acessórios de yoga',
                    'Equipamentos de musculação',
                    'Sistema de som profissional',
                    'Espelhos nas salas',
                    'Ar condicionado'
                ],
                'classes' => [
                    'Pilates Mat',
                    'Pilates Aparatos',
                    'Yoga Flow',
                    'Yoga Restaurativa',
                    'Pilates Suspenso',
                    'Meditação'
                ],
                'operating_hours' => [
                    'Segunda a Sexta: 7h às 22h',
                    'Sábado: 8h às 18h',
                    'Domingo: 9h às 17h'
                ],
                'contact' => [
                    'phone' => '(11) 2345-6789',
                    'email' => 'zonasul@fitplan.com.br',
                    'whatsapp' => '(11) 99999-5678'
                ]
            ],
            [
                'id' => 'zona-oeste',
                'name' => 'FitPlan Zona Oeste',
                'description' => 'Instalações premium com personal trainers',
                'address' => 'Av. Faria Lima, 2000 - Itaim Bibi, São Paulo - SP',
                'image' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=800&h=600&fit=crop&crop=center',
                'features' => [
                    'Instalações premium',
                    'Personal trainers exclusivos',
                    'Área VIP para membros Black',
                    'Spa e massagem',
                    'Restaurante gourmet',
                    'Valet parking'
                ],
                'equipment' => [
                    'Equipamentos Technogym premium',
                    'Máquinas de última geração',
                    'Área de treino funcional',
                    'Piscina aquecida',
                    'Sauna e steam room',
                    'Sala de recuperação'
                ],
                'classes' => [
                    'Personal Training',
                    'Pilates Privativo',
                    'Yoga Premium',
                    'CrossFit Elite',
                    'Aqua Fitness',
                    'Recuperação Ativa'
                ],
                'operating_hours' => [
                    'Segunda a Sexta: 5h às 24h',
                    'Sábado: 6h às 22h',
                    'Domingo: 7h às 21h'
                ],
                'contact' => [
                    'phone' => '(11) 1234-5678',
                    'email' => 'zonaoeste@fitplan.com.br',
                    'whatsapp' => '(11) 99999-9012'
                ]
            ]
        ];
    }

    /**
     * Obtém detalhes de uma unidade específica
     * 
     * @param string $unitId
     * @return array|null
     */
    private function getUnitDetails($unitId)
    {
        $units = $this->getAllUnits();
        
        foreach ($units as $unit) {
            if ($unit['id'] === $unitId) {
                return $unit;
            }
        }
        
        return null;
    }
}