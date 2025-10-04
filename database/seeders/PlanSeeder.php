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
            'description' => 'Ideal para iniciantes',
            'price' => 79.90,
            'features' => [
                'Acesso a equipamentos básicos',
                'Treino livre',
                'Vestiário com armários',
                'Horário: 6h às 22h'
            ],
            'is_active' => true,
        ]);

        Plan::create([
            'name' => 'Smart',
            'description' => 'Mais popular entre nossos alunos',
            'price' => 129.90,
            'features' => [
                'Todos os benefícios do Basic',
                'Aulas coletivas incluídas',
                'Avaliação física trimestral',
                'App de treinos personalizado',
                'Horário: 5h às 23h'
            ],
            'is_active' => true,
        ]);

        Plan::create([
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
            ],
            'is_active' => true,
        ]);

        $this->command->info('✅ Planos criados com sucesso!');
    }
}

