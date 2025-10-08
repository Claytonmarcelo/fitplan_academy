<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller para gerenciar treinos dos alunos
 * 
 * Este controller é responsável por:
 * - Exibir treinos disponíveis
 * - Gerenciar progresso dos treinos
 * - Controlar início e conclusão de treinos
 * - Exibir estatísticas de treinos
 * 
 * Arquitetura: Clean Architecture
 * - Separação de responsabilidades
 * - Código limpo e comentado
 * - Performance otimizada
 */
class WorkoutController extends Controller
{
    /**
     * Create a new controller instance.
     * Aplica middleware de autenticação demo
     */
    public function __construct()
    {
        $this->middleware('demo.auth');
    }

    /**
     * Exibe a página principal de treinos
     * 
     * @param Request $request
     * @return \Illuminate\View\View
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

        // Obter dados dos treinos
        $workouts = $this->getUserWorkouts();
        $workoutStats = $this->getWorkoutStats($user);
        $recentWorkouts = $this->getRecentWorkouts($user);

        return view('workouts.index', compact('user', 'workouts', 'workoutStats', 'recentWorkouts'));
    }

    /**
     * Exibe detalhes de um treino específico
     * 
     * @param Request $request
     * @param string $workoutId
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $workoutId)
    {
        $user = session()->get('demo_user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['login' => 'Sessão expirada.']);
        }
        
        $user = (object) $user;

        // Obter detalhes do treino
        $workout = $this->getWorkoutDetails($workoutId);
        
        if (!$workout) {
            return redirect()->route('workouts.index')->withErrors(['workout' => 'Treino não encontrado.']);
        }

        // Obter histórico de execução
        $executionHistory = $this->getWorkoutExecutionHistory($user, $workoutId);

        return view('workouts.show', compact('user', 'workout', 'executionHistory'));
    }

    /**
     * Inicia um treino
     * 
     * @param Request $request
     * @param string $workoutId
     * @return \Illuminate\Http\JsonResponse
     */
    public function start(Request $request, $workoutId)
    {
        $request->validate([
            'workout_id' => 'required|string',
        ]);

        $user = session()->get('demo_user');
        
        // Simular início do treino
        $workoutSession = [
            'id' => uniqid(),
            'workout_id' => $workoutId,
            'user_id' => $user['id'],
            'started_at' => now()->toISOString(),
            'status' => 'in_progress',
        ];

        // Salvar na sessão para demonstração
        session()->put('active_workout', $workoutSession);

        return response()->json([
            'success' => true,
            'message' => 'Treino iniciado com sucesso!',
            'workout_session' => $workoutSession,
        ]);
    }

    /**
     * Exibe a página de execução de treino com cronômetro
     * 
     * @param Request $request
     * @param string $workoutId
     * @return \Illuminate\View\View
     */
    public function execute(Request $request, $workoutId)
    {
        $user = session()->get('demo_user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['login' => 'Sessão expirada.']);
        }
        
        $user = (object) $user;

        // Obter detalhes do treino
        $workout = $this->getWorkoutDetails($workoutId);
        
        if (!$workout) {
            return redirect()->route('workouts.index')->withErrors(['workout' => 'Treino não encontrado.']);
        }

        // Adicionar informações extras para execução
        $workout['started_at'] = now();
        $workout['current_exercise'] = 0;
        $workout['total_exercises'] = count($workout['exercises']);

        return view('workouts.execute', compact('user', 'workout'));
    }

    /**
     * Marca um treino como concluído
     * 
     * @param Request $request
     * @param string $workoutId
     * @return \Illuminate\Http\JsonResponse
     */
    public function complete(Request $request, $workoutId)
    {
        $request->validate([
            'workout_id' => 'required|string',
            'duration_minutes' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:1000',
        ]);

        $user = session()->get('demo_user');
        
        // Simular conclusão do treino
        $completedWorkout = [
            'id' => uniqid(),
            'workout_id' => $workoutId,
            'user_id' => $user['id'],
            'completed_at' => now()->toISOString(),
            'duration_minutes' => $request->duration_minutes,
            'notes' => $request->notes,
            'status' => 'completed',
        ];

        // Remover treino ativo da sessão
        session()->forget('active_workout');

        return response()->json([
            'success' => true,
            'message' => 'Treino concluído com sucesso!',
            'completed_workout' => $completedWorkout,
        ]);
    }

    /**
     * Obtém treinos do usuário
     * 
     * @return array
     */
    private function getUserWorkouts()
    {
        return [
            [
                'id' => 'workout_a',
                'name' => 'Série A - Pernas',
                'description' => 'Treino focado no desenvolvimento dos membros inferiores',
                'duration' => 45,
                'difficulty' => 'intermediário',
                'muscle_groups' => ['pernas', 'glúteos'],
                'exercises' => [
                    ['name' => 'Agachamento Livre', 'sets' => '3x12', 'rest' => '60s'],
                    ['name' => 'Leg Press 45º', 'sets' => '4x10', 'rest' => '90s'],
                    ['name' => 'Cadeira Extensora', 'sets' => '4x15', 'rest' => '45s'],
                    ['name' => 'Panturrilha Sentado', 'sets' => '4x20', 'rest' => '30s'],
                ],
                'completed' => false,
                'last_completed' => null,
                'completion_rate' => 0,
            ],
            [
                'id' => 'workout_b',
                'name' => 'Série B - Peito e Tríceps',
                'description' => 'Desenvolvimento da parte superior do corpo',
                'duration' => 50,
                'difficulty' => 'intermediário',
                'muscle_groups' => ['peito', 'tríceps'],
                'exercises' => [
                    ['name' => 'Supino Reto', 'sets' => '4x8', 'rest' => '90s'],
                    ['name' => 'Crucifixo Inclinado', 'sets' => '3x12', 'rest' => '60s'],
                    ['name' => 'Tríceps Pulley', 'sets' => '4x10', 'rest' => '45s'],
                    ['name' => 'Mergulho no Banco', 'sets' => '3x15', 'rest' => '60s'],
                ],
                'completed' => true,
                'last_completed' => now()->subDays(2)->format('d/m/Y'),
                'completion_rate' => 100,
            ],
            [
                'id' => 'workout_c',
                'name' => 'Série C - Costas e Bíceps',
                'description' => 'Fortalecimento da musculatura posterior',
                'duration' => 45,
                'difficulty' => 'avançado',
                'muscle_groups' => ['costas', 'bíceps'],
                'exercises' => [
                    ['name' => 'Barra Fixa', 'sets' => '3xFalha', 'rest' => '120s'],
                    ['name' => 'Remada Curvada', 'sets' => '4x10', 'rest' => '90s'],
                    ['name' => 'Puxada Alta', 'sets' => '3x12', 'rest' => '60s'],
                    ['name' => 'Rosca Direta', 'sets' => '4x12', 'rest' => '45s'],
                ],
                'completed' => false,
                'last_completed' => now()->subDays(5)->format('d/m/Y'),
                'completion_rate' => 75,
            ],
        ];
    }

    /**
     * Obtém estatísticas de treinos do usuário
     * 
     * @param object $user
     * @return array
     */
    private function getWorkoutStats($user)
    {
        return [
            'total_workouts' => 12,
            'completed_this_week' => 3,
            'streak_days' => 5,
            'total_minutes' => 540,
            'favorite_muscle_group' => 'pernas',
            'average_duration' => 45,
            'completion_rate' => 85,
        ];
    }

    /**
     * Obtém treinos recentes do usuário
     * 
     * @param object $user
     * @return array
     */
    private function getRecentWorkouts($user)
    {
        return [
            [
                'workout_name' => 'Série B - Peito e Tríceps',
                'completed_at' => now()->subDays(2)->format('d/m/Y H:i'),
                'duration' => 48,
                'rating' => 4,
            ],
            [
                'workout_name' => 'Série A - Pernas',
                'completed_at' => now()->subDays(4)->format('d/m/Y H:i'),
                'duration' => 42,
                'rating' => 5,
            ],
            [
                'workout_name' => 'Série C - Costas e Bíceps',
                'completed_at' => now()->subDays(5)->format('d/m/Y H:i'),
                'duration' => 50,
                'rating' => 3,
            ],
        ];
    }

    /**
     * Obtém detalhes de um treino específico
     * 
     * @param string $workoutId
     * @return array|null
     */
    private function getWorkoutDetails($workoutId)
    {
        $workouts = $this->getUserWorkouts();
        
        foreach ($workouts as $workout) {
            if ($workout['id'] === $workoutId) {
                return $workout;
            }
        }
        
        return null;
    }

    /**
     * Obtém histórico de execução de um treino
     * 
     * @param object $user
     * @param string $workoutId
     * @return array
     */
    private function getWorkoutExecutionHistory($user, $workoutId)
    {
        return [
            [
                'date' => now()->subDays(2)->format('d/m/Y'),
                'duration' => 48,
                'notes' => 'Treino intenso, boa performance',
                'rating' => 4,
            ],
            [
                'date' => now()->subDays(9)->format('d/m/Y'),
                'duration' => 45,
                'notes' => 'Primeira execução do treino',
                'rating' => 3,
            ],
        ];
    }
}
