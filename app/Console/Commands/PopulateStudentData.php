<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Features\User\Infrastructure\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * Comando para popular dados de exemplo dos alunos
 * Demonstração do dashboard do aluno
 */
class PopulateStudentData extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'student:populate';

    /**
     * The console command description.
     */
    protected $description = 'Popula dados de exemplo para demonstrar o dashboard do aluno';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🏋️ Personalizando dados do aluno para demonstração...');

        // Buscar ou criar um usuário comum para demonstração
        $student = [];

        // Criar logs de acesso para simular frequência
        $this->createAccessLogs();
        
        // Criar treinos simulados
        $this->createWorkouts();
        
        // Criar metas simuladas
        $this->createGoals();

        $this->info('✅ Dados de demonstração criados com sucesso!');
        $this->info('🎯 Acesse: http://localhost:8000/dashboard-aluno');
        $this->info('👤 Como usuário comum ou use o link no dashboard Master');
    }

    /**
     * Criar logs de acesso simulados
     */
    private function createAccessLogs()
    {
        // Buscar um usuário comum ou o Master para simular
        $user = User::where('profile', 'comum')->first() ?? User::where('profile', 'master')->first();
        
        if (!$user) {
            $this->warn('❌ Nenhum usuário encontrado para criar logs');
            return;
        }

        // Criar 15-20 logs de acesso nos últimos 20 dias para mostrar frequência
        $logsToInsert = [];
        
        for ($i = 0; $i < 17; $i++) {
            $date = now()->subDays(rand(1, 20));
            
            $logsToInsert[] = [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_cpf' => $user->cpf,
                'user_login' => $user->login,
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Demo Browser)',
                'two_factor_used' => true,
                'login_successful' => true,
                'created_at' => $date,
                'updated_at' => $date,
            ];
        }

        // Limpar logs existentes do usuário para esta demonstração
        DB::table('access_logs')->where('user_id', $user->id)->delete();
        
        // Inserir novos logs
        DB::table('access_logs')->insert($logsToInsert);

        $this->info("📊 Criados " . count($logsToInsert) . " logs de acesso para {$user->name}");
    }

    /**
     * Criar treinos simulados (se a tabela existir)
     */
    private function createWorkouts()
    {
        try {
            // Verificar se a tabela existe
            if (!DB::getSchemaBuilder()->hasTable('student_workouts')) {
                $this->warn('⚠️ Tabela student_workouts não existe ainda. Execute as migrações primeiro.');
                return;
            }

            $user = User::where('profile', 'comum')->first() ?? User::where('profile', 'master')->first();
            
            if (!$user) {
                $this->warn('❌ Nenhum usuário encontrado para criar treinos');
                return;
            }

            $workouts = [
                [
                    'user_id' => $user->id,
                    'workout_name' => 'Série A - Pernas',
                    'duration_minutes' => 45,
                    'exercises' => json_encode([
                        ['name' => 'Agachamento Livre', 'sets' => '3x12'],
                        ['name' => 'Leg Press 45º', 'sets' => '4x10'],
                        ['name' => 'Cadeira Extensora', 'sets' => '4x15'],
                        ['name' => 'Panturrilha Sentado', 'sets' => '4x20'],
                    ]),
                    'completed' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'user_id' => $user->id,
                    'workout_name' => 'Série B - Peito e Tríceps',
                    'duration_minutes' => 50,
                    'exercises' => json_encode([
                        ['name' => 'Supino Reto', 'sets' => '4x8'],
                        ['name' => 'Crucifixo Inclinado', 'sets' => '3x12'],
                        ['name' => 'Tríceps Pulley', 'sets' => '4x10'],
                        ['name' => 'Mergulho no Banco', 'sets' => '3x15'],
                    ]),
                    'completed' => true,
                    'started_at' => now()->subHours(2),
                    'completed_at' => now()->subHours(1),
                    'created_at' => now()->subDays(2),
                    'updated_at' => now()->subHours(1),
                ],
                [
                    'user_id' => $user->id,
                    'workout_name' => 'Série C - Costas e Bíceps',
                    'duration_minutes' => 45,
                    'exercises' => json_encode([
                        ['name' => 'Barra Fixa', 'sets' => '3xFalha'],
                        ['name' => 'Remada Curvada', 'sets' => '4x10'],
                        ['name' => 'Puxada Alta', 'sets' => '3x12'],
                        ['name' => 'Rosca Direta', 'sets' => '4x12'],
                    ]),
                    'completed' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];

            // Limpar treinos existentes do usuário para esta demonstração
            DB::table('student_workouts')->where('user_id', $user->id)->delete();
            
            // Inserir novos treinos
            DB::table('student_workouts')->insert($workouts);

            $this->info("💪 Criados " . count($workouts) . " treinos para {$user->name}");
        } catch (\Exception $e) {
            $this->warn('⚠️ Erro ao criar treinos: ' . $e->getMessage());
        }
    }

    /**
     * Criar metas simuladas (se a tabela existir)
     */
    private function createGoals()
    {
        try {
            // Verificar se a tabela existe
            if (!DB::getSchemaBuilder()->hasTable('student_goals')) {
                $this->warn('⚠️ Tabela student_goals não existe ainda. Execute as migrações primeiro.');
                return;
            }

            $user = User::where('profile', 'comum')->first() ?? User::where('profile', 'master')->first();
            
            if (!$user) {
                $this->warn('❌ Nenhum usuário encontrado para criar metas');
                return;
            }

            $goals = [
                [
                    'user_id' => $user->id,
                    'title' => 'Perder 5kg',
                    'description' => 'Meta mensal de redução de peso',
                    'type' => 'peso',
                    'target_value' => 75.00,
                    'target_unit' => 'kg',
                    'current_value' => 78.50,
                    'target_date' => now()->addMonths(1)->format('Y-m-d'),
                    'is_achieved' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'user_id' => $user->id,
                    'title' => 'Frequência de 4x por semana',
                    'description' => 'Treinar pelo menos 4 dias por semana',
                    'type' => 'frequencia',
                    'target_value' => 16.0,
                    'target_unit' => 'dias',
                    'current_value' => 12.0,
                    'target_date' => now()->endOfMonth()->format('Y-m-d'),
                    'is_achieved' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];

            // Limpar metas existentes do usuário para esta demonstração
            DB::table('student_goals')->where('user_id', $user->id)->delete();
            
            // Inserir novas metas
            DB::table('student_goals')->insert($goals);

            $this->info("🎯 Criadas " . count($goals) . " metas para {$user->name}");
        } catch (\Exception $e) {
            $this->warn('⚠️ Erro ao criar metas: ' . $e->getMessage());
        }
    }
}