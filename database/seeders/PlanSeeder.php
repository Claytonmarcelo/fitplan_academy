<?php

namespace Database\Seeders;

use App\Features\Plan\Infrastructure\Models\Plan;
use Illuminate\Database\Seeder;

/**
 * Seeder de Planos
 * 
 * Cria os 3 planos padrão: Basic, Smart, Black
 */
class PlanSeeder extends Seeder
{
    public function run(): void
    {
        Plan::create([
            'name' => 'Basic',
            'description' => 'Plano básico com acesso à academia e aulas em grupo',
            'price' => 99.00,
            'features' => [
                'Acesso às instalações básicas da academia',
                'Aulas de fitness em grupo',
                'Plano de treino personalizado',
            ],
            'is_active' => true,
        ]);

        Plan::create([
            'name' => 'Smart',
            'description' => 'Plano intermediário com treinos avançados e nutrição',
            'price' => 149.00,
            'features' => [
                'Todas as funcionalidades do plano Basic',
                'Programas de treinamento avançados',
                'Orientação nutricional',
                'Acompanhamento de progresso',
            ],
            'is_active' => true,
        ]);

        Plan::create([
            'name' => 'Black',
            'description' => 'Plano premium com acesso ilimitado e personal trainer',
            'price' => 249.00,
            'features' => [
                'Todas as funcionalidades do plano Smart',
                'Acesso exclusivo às instalações premium',
                'Sessões ilimitadas de personal trainer',
                'Prioridade na reserva de aulas',
            ],
            'is_active' => true,
        ]);

        $this->command->info('✅ Planos criados com sucesso!');
    }
}

