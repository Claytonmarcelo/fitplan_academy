<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of all units
     */
    public function index()
    {
        $units = [
            [
                'id' => 'centro',
                'name' => 'Centro',
                'address' => 'Av. Paulista, 1000 - São Paulo',
                'description' => 'Nossa unidade principal no coração de São Paulo, oferecendo uma experiência completa de fitness com equipamentos de última geração.',
                'image' => 'https://images.unsplash.com/photo-1540497077202-7c8a3999166f?w=800',
                'features' => [
                    'Equipamentos modernos e tecnológicos',
                    'Aulas em grupo diversificadas',
                    'Personal trainers especializados',
                    'Área de musculação completa',
                    'Sala de spinning',
                    'Estúdio de pilates',
                    'Vestiários com chuveiros',
                    'Estacionamento próprio',
                    'Wi-Fi gratuito',
                    'Horário estendido (5h às 23h)'
                ],
                'equipment' => [
                    'Máquinas de musculação Life Fitness',
                    'Esteiras Technogym com TV',
                    'Bicicletas ergométricas',
                    'Equipamentos de funcional',
                    'Barras e halteres',
                    'Máquinas de cardio',
                    'Equipamentos de pilates',
                    'Espaço para crossfit'
                ],
                'classes' => [
                    'Musculação',
                    'Pilates',
                    'Spinning',
                    'Funcional',
                    'Crossfit',
                    'Yoga',
                    'Zumba',
                    'Body Pump'
                ],
                'hours' => [
                    'Segunda a Sexta: 5h às 23h',
                    'Sábado: 6h às 22h',
                    'Domingo: 7h às 20h'
                ],
                'contact' => [
                    'phone' => '(11) 9999-0001',
                    'email' => 'centro@fitplanacademy.com.br'
                ]
            ],
            [
                'id' => 'zona-sul',
                'name' => 'Zona Sul',
                'address' => 'Rua Augusta, 500 - São Paulo',
                'description' => 'Unidade especializada em aulas em grupo e pilates, com foco em bem-estar e qualidade de vida.',
                'image' => 'https://images.unsplash.com/photo-1571902943202-507ec2618e8f?w=800',
                'features' => [
                    'Foco em aulas em grupo',
                    'Estúdio de pilates completo',
                    'Instrutores certificados',
                    'Área de musculação básica',
                    'Sala de dança',
                    'Espaço para yoga',
                    'Vestiários modernos',
                    'Estacionamento',
                    'Wi-Fi gratuito',
                    'Horário comercial (6h às 22h)'
                ],
                'equipment' => [
                    'Equipamentos de pilates',
                    'Máquinas de musculação básica',
                    'Esteiras e bicicletas',
                    'Equipamentos de funcional',
                    'Espaço para dança',
                    'Materiais de yoga',
                    'Barras e halteres',
                    'Equipamentos de cardio'
                ],
                'classes' => [
                    'Pilates',
                    'Yoga',
                    'Zumba',
                    'Funcional',
                    'Dança',
                    'Musculação',
                    'Spinning',
                    'Body Pump'
                ],
                'hours' => [
                    'Segunda a Sexta: 6h às 22h',
                    'Sábado: 7h às 21h',
                    'Domingo: 8h às 19h'
                ],
                'contact' => [
                    'phone' => '(11) 9999-0002',
                    'email' => 'zonasul@fitplanacademy.com.br'
                ]
            ],
            [
                'id' => 'zona-oeste',
                'name' => 'Zona Oeste',
                'address' => 'Av. Faria Lima, 2000 - São Paulo',
                'description' => 'Nossa unidade premium com instalações de alto padrão e personal trainers exclusivos.',
                'image' => 'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=800',
                'features' => [
                    'Instalações premium',
                    'Personal trainers exclusivos',
                    'Equipamentos de última geração',
                    'Área VIP de musculação',
                    'Sala de spinning premium',
                    'Estúdio de pilates',
                    'Spa e sauna',
                    'Vestiários luxuosos',
                    'Estacionamento valet',
                    'Horário estendido (5h às 24h)'
                ],
                'equipment' => [
                    'Máquinas de musculação Technogym',
                    'Esteiras premium com TV',
                    'Bicicletas ergométricas',
                    'Equipamentos de funcional',
                    'Barras e halteres premium',
                    'Máquinas de cardio',
                    'Equipamentos de pilates',
                    'Espaço para crossfit'
                ],
                'classes' => [
                    'Musculação Premium',
                    'Pilates',
                    'Spinning Premium',
                    'Funcional',
                    'Crossfit',
                    'Yoga',
                    'Zumba',
                    'Body Pump'
                ],
                'hours' => [
                    'Segunda a Sexta: 5h às 24h',
                    'Sábado: 6h às 23h',
                    'Domingo: 7h às 21h'
                ],
                'contact' => [
                    'phone' => '(11) 9999-0003',
                    'email' => 'zonaoeste@fitplanacademy.com.br'
                ]
            ]
        ];

        return view('units.index', compact('units'));
    }

    /**
     * Display the specified unit
     */
    public function show(Request $request, $unitId)
    {
        $units = [
            'centro' => [
                'id' => 'centro',
                'name' => 'Centro',
                'address' => 'Av. Paulista, 1000 - São Paulo',
                'description' => 'Nossa unidade principal no coração de São Paulo, oferecendo uma experiência completa de fitness com equipamentos de última geração.',
                'image' => 'https://images.unsplash.com/photo-1540497077202-7c8a3999166f?w=800',
                'features' => [
                    'Equipamentos modernos e tecnológicos',
                    'Aulas em grupo diversificadas',
                    'Personal trainers especializados',
                    'Área de musculação completa',
                    'Sala de spinning',
                    'Estúdio de pilates',
                    'Vestiários com chuveiros',
                    'Estacionamento próprio',
                    'Wi-Fi gratuito',
                    'Horário estendido (5h às 23h)'
                ],
                'equipment' => [
                    'Máquinas de musculação Life Fitness',
                    'Esteiras Technogym com TV',
                    'Bicicletas ergométricas',
                    'Equipamentos de funcional',
                    'Barras e halteres',
                    'Máquinas de cardio',
                    'Equipamentos de pilates',
                    'Espaço para crossfit'
                ],
                'classes' => [
                    'Musculação',
                    'Pilates',
                    'Spinning',
                    'Funcional',
                    'Crossfit',
                    'Yoga',
                    'Zumba',
                    'Body Pump'
                ],
                'hours' => [
                    'Segunda a Sexta: 5h às 23h',
                    'Sábado: 6h às 22h',
                    'Domingo: 7h às 20h'
                ],
                'contact' => [
                    'phone' => '(11) 9999-0001',
                    'email' => 'centro@fitplanacademy.com.br'
                ]
            ],
            'zona-sul' => [
                'id' => 'zona-sul',
                'name' => 'Zona Sul',
                'address' => 'Rua Augusta, 500 - São Paulo',
                'description' => 'Unidade especializada em aulas em grupo e pilates, com foco em bem-estar e qualidade de vida.',
                'image' => 'https://images.unsplash.com/photo-1571902943202-507ec2618e8f?w=800',
                'features' => [
                    'Foco em aulas em grupo',
                    'Estúdio de pilates completo',
                    'Instrutores certificados',
                    'Área de musculação básica',
                    'Sala de dança',
                    'Espaço para yoga',
                    'Vestiários modernos',
                    'Estacionamento',
                    'Wi-Fi gratuito',
                    'Horário comercial (6h às 22h)'
                ],
                'equipment' => [
                    'Equipamentos de pilates',
                    'Máquinas de musculação básica',
                    'Esteiras e bicicletas',
                    'Equipamentos de funcional',
                    'Espaço para dança',
                    'Materiais de yoga',
                    'Barras e halteres',
                    'Equipamentos de cardio'
                ],
                'classes' => [
                    'Pilates',
                    'Yoga',
                    'Zumba',
                    'Funcional',
                    'Dança',
                    'Musculação',
                    'Spinning',
                    'Body Pump'
                ],
                'hours' => [
                    'Segunda a Sexta: 6h às 22h',
                    'Sábado: 7h às 21h',
                    'Domingo: 8h às 19h'
                ],
                'contact' => [
                    'phone' => '(11) 9999-0002',
                    'email' => 'zonasul@fitplanacademy.com.br'
                ]
            ],
            'zona-oeste' => [
                'id' => 'zona-oeste',
                'name' => 'Zona Oeste',
                'address' => 'Av. Faria Lima, 2000 - São Paulo',
                'description' => 'Nossa unidade premium com instalações de alto padrão e personal trainers exclusivos.',
                'image' => 'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=800',
                'features' => [
                    'Instalações premium',
                    'Personal trainers exclusivos',
                    'Equipamentos de última geração',
                    'Área VIP de musculação',
                    'Sala de spinning premium',
                    'Estúdio de pilates',
                    'Spa e sauna',
                    'Vestiários luxuosos',
                    'Estacionamento valet',
                    'Horário estendido (5h às 24h)'
                ],
                'equipment' => [
                    'Máquinas de musculação Technogym',
                    'Esteiras premium com TV',
                    'Bicicletas ergométricas',
                    'Equipamentos de funcional',
                    'Barras e halteres premium',
                    'Máquinas de cardio',
                    'Equipamentos de pilates',
                    'Espaço para crossfit'
                ],
                'classes' => [
                    'Musculação Premium',
                    'Pilates',
                    'Spinning Premium',
                    'Funcional',
                    'Crossfit',
                    'Yoga',
                    'Zumba',
                    'Body Pump'
                ],
                'hours' => [
                    'Segunda a Sexta: 5h às 24h',
                    'Sábado: 6h às 23h',
                    'Domingo: 7h às 21h'
                ],
                'contact' => [
                    'phone' => '(11) 9999-0003',
                    'email' => 'zonaoeste@fitplanacademy.com.br'
                ]
            ]
        ];

        if (!isset($units[$unitId])) {
            abort(404, 'Unidade não encontrada');
        }

        $unit = $units[$unitId];
        $otherUnits = array_filter($units, function($key) use ($unitId) {
            return $key !== $unitId;
        }, ARRAY_FILTER_USE_KEY);

        return view('units.show', compact('unit', 'otherUnits'));
    }
}
