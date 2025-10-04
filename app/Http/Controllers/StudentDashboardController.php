<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Features\User\Infrastructure\Models\User;
use App\Models\AccessLog;

/**
 * Controller para o Dashboard do Aluno
 * 
 * Exibe informações personalizadas do aluno logado
 * incluindo estatísticas de frequência, metas e treinos
 */
class StudentDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Exibe o dashboard do aluno
     */
    public function index(Request $request)
    {
        // Obter usuário da sessão demo
        $user = session()->get('demo_user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['login' => 'Sessão expirada.']);
        }
        
        $user = (object) $user;
        
        // Se for usuário Master, redireciona para o dashboard administrativo
        if ($user->profile === 'master') {
            return redirect()->route('dashboard');
        }

        // Calcular estatísticas do aluno
        $stats = $this->getStudentStats($user);

        return view('student-dashboard', compact('user', 'stats'));
    }

    /**
     * Calcula estatísticas do estudante
     */
    private function getStudentStats(User $user)
    {
        // Frequência do mês (simulado para demonstração)
        $frequencyThisMonth = $this->calculateMonthlyFrequency($user);

        // Progresso das metas (simulado para demonstração)
        $goalProgress = $this->calculateGoalProgress($user);

        // Data de vencimento (simulada)
        $nextDueDate = now()->addDays(rand(5, 15));

        return [
            'frequency_this_month' => $frequencyThisMonth,
            'goal_progress' => $goalProgress,
            'next_due_date' => $nextDueDate,
            'total_workouts' => $this->getTotalWorkouts($user),
            'active_streak' => $this->getActiveStreak($user),
        ];
    }

    /**
     * Calcula a frequência do mês atual
     */
    private function calculateMonthlyFrequency(User $user)
    {
        // Buscar logs de acesso do usuário nos últimos 30 dias
        $monthStart = now()->startOfMonth();
        $monthEnd = now()->endOfMonth();

        $accessLogs = AccessLog::where('user_id', $user->id)
            ->where('login_successful', true)
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->distinct('created_at')
            ->count();

        // Retorna um valor entre 10-20 para demonstração
        return min($accessLogs, 20);
    }

    /**
     * Calcula o progresso das metas do aluno
     */
    private function calculateGoalProgress(User $user)
    {
        // Simular progresso baseado em dados dos treinos
        // Em uma implementação real, isso viria de uma tabela de metas/exercícios
        
        $baseProgress = rand(60, 90);
        
        // Usuários mais novos têm progresso menor
        $daysSinceCreated = now()->diffInDays($user->created_at);
        if ($daysSinceCreated < 30) {
            $baseProgress = rand(40, 60);
        }
        
        return $baseProgress;
    }

    /**
     * Obtém o total de treinos do usuário
     */
    private function getTotalWorkouts(User $user)
    {
        // Simulado - em implementação real viria de uma tabela de workouts
        $daysSinceCreated = now()->diffInDays($user->created_at);
        return min($daysSinceCreated * rand(2, 4), 100);
    }

    /**
     * Obtém a sequência ativa de dias consecutivos treinando
     */
    private function getActiveStreak(User $user)
    {
        // Simulado - calcula sequência baseada nos logs de acesso
        $streak = 0;
        $currentDate = now();
        
        for ($i = 0; $i < 30; $i++) {
            $date = $currentDate->copy()->subDays($i);
            
            $hasAccess = AccessLog::where('user_id', $user->id)
                ->where('login_successful', true)
                ->whereDate('created_at', $date->format('Y-m-d'))
                ->exists();
                
            if ($hasAccess) {
                $streak++;
            } else {
                break;
            }
        }
        
        return $streak;
    }

    /**
     * AJAX: Marca treino como concluído
     */
    public function markWorkoutCompleted(Request $request)
    {
        $request->validate([
            'workout_id' => 'required|string',
        ]);

        $user = Auth::user();

        // Em uma implementação real, salvaria em uma tabela workouts/training_sessions
        // Por enquanto, apenas retorna sucesso

        return response()->json([
            'success' => true,
            'message' => 'Treino marcado como concluído!',
        ]);
    }

    /**
     * AJAX: Inicia um treino
     */
    public function startWorkout(Request $request)
    {
        $request->validate([
            'workout_id' => 'required|string',
        ]);

        $user = Auth::user();

        // Em uma implementação real, criaria uma sessão de treino ativa
        // Por enquanto, apenas retorna sucesso

        return response()->json([
            'success' => true,
            'message' => 'Treino iniciado!',
            'workout_started_at' => now()->toISOString(),
        ]);
    }

    /**
     * Obter dados de treinos do usuário
     */
    public function getUserWorkouts()
    {
        $user = Auth::user();

        // Treinos simulados padrão
        $workouts = [
            [
                'id' => 'workout_a',
                'name' => 'Série A - Pernas',
                'duration' => 45,
                'exercises' => [
                    ['name' => 'Agachamento Livre', 'sets' => '3x12'],
                    ['name' => 'Leg Press 45º', 'sets' => '4x10'],
                    ['name' => 'Cadeira Extensora', 'sets' => '4x15'],
                    ['name' => 'Panturrilha Sentado', 'sets' => '4x20'],
                ],
                'completed' => false,
            ],
            [
                'id' => 'workout_b',
                'name' => 'Série B - Peito e Tríceps',
                'duration' => 50,
                'exercises' => [
                    ['name' => 'Supino Reto', 'sets' => '4x8'],
                    ['name' => 'Crucifixo Inclinado', 'sets' => '3x12'],
                    ['name' => 'Tríceps Pulley', 'sets' => '4x10'],
                    ['name' => 'Mergulho no Banco', 'sets' => '3x15'],
                ],
                'completed' => true,
            ],
            [
                'id' => 'workout_c',
                'name' => 'Série C - Costas e Bíceps',
                'duration' => 45,
                'exercises' => [
                    ['name' => 'Barra Fixa', 'sets' => '3xFalha'],
                    ['name' => 'Remada Curvada', 'sets' => '4x10'],
                    ['name' => 'Puxada Alta', 'sets' => '3x12'],
                    ['name' => 'Rosca Direta', 'sets' => '4x12'],
                ],
                'completed' => false,
            ],
        ];

        return response()->json([
            'success' => true,
            'workouts' => $workouts,
        ]);
    }
}
