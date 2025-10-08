<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller para gerenciar desafios da academia
 * 
 * Este controller é responsável por:
 * - Exibir desafios disponíveis
 * - Gerenciar participação em desafios
 * - Controlar progresso dos desafios
 * - Exibir ranking e conquistas
 * 
 * Arquitetura: Clean Architecture
 * - Separação de responsabilidades
 * - Código limpo e comentado
 * - Performance otimizada
 */
class ChallengeController extends Controller
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
     * Exibe a página principal de desafios
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

        // Obter dados dos desafios
        $activeChallenges = $this->getActiveChallenges();
        $userChallenges = $this->getUserChallenges($user);
        $achievements = $this->getUserAchievements($user);
        $leaderboard = $this->getLeaderboard();

        return view('challenges.index', compact('user', 'activeChallenges', 'userChallenges', 'achievements', 'leaderboard'));
    }

    /**
     * Exibe detalhes de um desafio específico
     * 
     * @param Request $request
     * @param string $challengeId
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $challengeId)
    {
        $user = session()->get('demo_user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['login' => 'Sessão expirada.']);
        }
        
        $user = (object) $user;

        // Obter detalhes do desafio
        $challenge = $this->getChallengeDetails($challengeId);
        
        if (!$challenge) {
            return redirect()->route('challenges.index')->withErrors(['challenge' => 'Desafio não encontrado.']);
        }

        // Verificar se usuário está participando
        $userProgress = $this->getUserChallengeProgress($user, $challengeId);

        return view('challenges.show', compact('user', 'challenge', 'userProgress'));
    }

    /**
     * Participa de um desafio
     * 
     * @param Request $request
     * @param string $challengeId
     * @return \Illuminate\Http\JsonResponse
     */
    public function join(Request $request, $challengeId)
    {
        $request->validate([
            'challenge_id' => 'required|string',
        ]);

        $user = session()->get('demo_user');
        
        // Simular participação no desafio
        $participation = [
            'id' => uniqid(),
            'challenge_id' => $challengeId,
            'user_id' => $user['id'],
            'joined_at' => now()->toISOString(),
            'status' => 'active',
            'progress' => 0,
        ];

        // Salvar na sessão para demonstração
        $participations = session()->get('challenge_participations', []);
        $participations[] = $participation;
        session()->put('challenge_participations', $participations);

        return response()->json([
            'success' => true,
            'message' => 'Você entrou no desafio com sucesso!',
            'participation' => $participation,
        ]);
    }

    /**
     * Atualiza progresso de um desafio
     * 
     * @param Request $request
     * @param string $challengeId
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProgress(Request $request, $challengeId)
    {
        $request->validate([
            'challenge_id' => 'required|string',
            'progress_value' => 'required|numeric|min:0',
        ]);

        $user = session()->get('demo_user');
        
        // Simular atualização do progresso
        $participations = session()->get('challenge_participations', []);
        
        foreach ($participations as &$participation) {
            if ($participation['challenge_id'] === $challengeId && $participation['user_id'] === $user['id']) {
                $participation['progress'] = $request->progress_value;
                $participation['last_updated'] = now()->toISOString();
                
                // Verificar se desafio foi completado
                $challenge = $this->getChallengeDetails($challengeId);
                if ($request->progress_value >= $challenge['target_value']) {
                    $participation['status'] = 'completed';
                    $participation['completed_at'] = now()->toISOString();
                }
                break;
            }
        }
        
        session()->put('challenge_participations', $participations);

        return response()->json([
            'success' => true,
            'message' => 'Progresso atualizado com sucesso!',
            'progress' => $request->progress_value,
        ]);
    }

    /**
     * Obtém desafios ativos
     * 
     * @return array
     */
    private function getActiveChallenges()
    {
        return [
            [
                'id' => 'challenge_1',
                'name' => 'Desafio 30 Dias',
                'description' => 'Complete 30 treinos em 30 dias consecutivos',
                'type' => 'streak',
                'target_value' => 30,
                'unit' => 'dias',
                'reward' => 'Camiseta exclusiva + 1 mês grátis',
                'start_date' => now()->subDays(5)->format('d/m/Y'),
                'end_date' => now()->addDays(25)->format('d/m/Y'),
                'participants' => 156,
                'difficulty' => 'intermediário',
                'category' => 'resistência',
            ],
            [
                'id' => 'challenge_2',
                'name' => 'Queima de Calorias',
                'description' => 'Queime 10.000 calorias em 2 semanas',
                'type' => 'calories',
                'target_value' => 10000,
                'unit' => 'calorias',
                'reward' => 'Suplemento pré-treino + desconto 20%',
                'start_date' => now()->subDays(3)->format('d/m/Y'),
                'end_date' => now()->addDays(11)->format('d/m/Y'),
                'participants' => 89,
                'difficulty' => 'avançado',
                'category' => 'cardio',
            ],
            [
                'id' => 'challenge_3',
                'name' => 'Flexibilidade Total',
                'description' => 'Participe de 20 aulas de yoga/pilates',
                'type' => 'classes',
                'target_value' => 20,
                'unit' => 'aulas',
                'reward' => 'Mat de yoga premium + aula particular',
                'start_date' => now()->subDays(7)->format('d/m/Y'),
                'end_date' => now()->addDays(21)->format('d/m/Y'),
                'participants' => 67,
                'difficulty' => 'iniciante',
                'category' => 'flexibilidade',
            ],
        ];
    }

    /**
     * Obtém desafios do usuário
     * 
     * @param object $user
     * @return array
     */
    private function getUserChallenges($user)
    {
        return [
            [
                'challenge_name' => 'Desafio 30 Dias',
                'progress' => 5,
                'target' => 30,
                'status' => 'active',
                'days_remaining' => 25,
            ],
            [
                'challenge_name' => 'Queima de Calorias',
                'progress' => 3500,
                'target' => 10000,
                'status' => 'active',
                'days_remaining' => 11,
            ],
            [
                'challenge_name' => 'Flexibilidade Total',
                'progress' => 8,
                'target' => 20,
                'status' => 'active',
                'days_remaining' => 21,
            ],
        ];
    }

    /**
     * Obtém conquistas do usuário
     * 
     * @param object $user
     * @return array
     */
    private function getUserAchievements($user)
    {
        return [
            [
                'name' => 'Primeiro Treino',
                'description' => 'Complete seu primeiro treino',
                'icon' => '🏆',
                'earned_at' => now()->subDays(30)->format('d/m/Y'),
                'status' => 'earned',
            ],
            [
                'name' => 'Semana Perfeita',
                'description' => 'Treine todos os dias da semana',
                'icon' => '⭐',
                'earned_at' => now()->subDays(14)->format('d/m/Y'),
                'status' => 'earned',
            ],
            [
                'name' => 'Maratonista',
                'description' => 'Complete 100 treinos',
                'icon' => '🏃‍♂️',
                'earned_at' => null,
                'status' => 'locked',
            ],
        ];
    }

    /**
     * Obtém ranking de usuários
     * 
     * @return array
     */
    private function getLeaderboard()
    {
        return [
            [
                'position' => 1,
                'name' => 'Carlos Silva',
                'points' => 2450,
                'avatar' => 'CS',
            ],
            [
                'position' => 2,
                'name' => 'Ana Costa',
                'points' => 2380,
                'avatar' => 'AC',
            ],
            [
                'position' => 3,
                'name' => 'João Santos',
                'points' => 2200,
                'avatar' => 'JS',
            ],
            [
                'position' => 4,
                'name' => 'Sofia Maria',
                'points' => 1950,
                'avatar' => 'SM',
            ],
            [
                'position' => 5,
                'name' => 'Pedro Lima',
                'points' => 1800,
                'avatar' => 'PL',
            ],
        ];
    }

    /**
     * Obtém detalhes de um desafio específico
     * 
     * @param string $challengeId
     * @return array|null
     */
    private function getChallengeDetails($challengeId)
    {
        $challenges = $this->getActiveChallenges();
        
        foreach ($challenges as $challenge) {
            if ($challenge['id'] === $challengeId) {
                return $challenge;
            }
        }
        
        return null;
    }

    /**
     * Obtém progresso do usuário em um desafio
     * 
     * @param object $user
     * @param string $challengeId
     * @return array
     */
    private function getUserChallengeProgress($user, $challengeId)
    {
        $participations = session()->get('challenge_participations', []);
        
        foreach ($participations as $participation) {
            if ($participation['challenge_id'] === $challengeId && $participation['user_id'] === $user['id']) {
                return $participation;
            }
        }
        
        return [
            'status' => 'not_participating',
            'progress' => 0,
        ];
    }
}
