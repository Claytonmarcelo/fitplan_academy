<?php

namespace App\Http\Controllers;

use App\Features\User\Infrastructure\Models\User;
use App\Models\AccessLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * DashboardController
 * 
 * Controller principal do sistema após login.
 * Exibe menu e informações dos produtos/planos.
 */
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Exibe o dashboard principal
     */
    public function index(Request $request)
    {
        // Obter usuário da sessão demo
        $user = session()->get('demo_user');
        if (!$user) {
            return redirect()->route('login')->withErrors(['login' => 'Sessão expirada.']);
        }
        
        // Converter para objeto
        $user = (object) $user;
        $user->isMaster = function() use ($user) {
            return $user->profile === 'master';
        };
        $user->isCommon = function() use ($user) {
            return $user->profile === 'comum';
        };
        
        // Se for usuário comum, redireciona para o dashboard do aluno
        if ($user->isCommon()) {
            return redirect()->route('student.dashboard');
        }
        
        // Estatísticas simuladas para demo
        $stats = [
            'total_users' => 47,
            'active_users' => 42,
            'total_logins_today' => 18,
            'failed_logins_today' => 3,
        ];

        // Planos disponíveis
        $plans = [
            [
                'id' => 1,
                'name' => 'Basic',
                'price' => 79.90,
                'description' => 'Ideal para iniciantes',
                'features' => [
                    'Acesso a equipamentos básicos',
                    'Treino livre',
                    'Vestiário com armários',
                    'Horário: 6h às 22h'
                ],
                'popular' => false
            ],
            [
                'id' => 2,
                'name' => 'Smart',
                'price' => 129.90,
                'description' => 'Mais popular entre nossos alunos',
                'features' => [
                    'Todos os benefícios do Basic',
                    'Aulas coletivas incluídas',
                    'Avaliação física trimestral',
                    'App de treinos personalizado',
                    'Horário: 5h às 23h'
                ],
                'popular' => true
            ],
            [
                'id' => 3,
                'name' => 'Black',
                'price' => 199.90,
                'description' => 'Premium e completo',
                'features' => [
                    'Todos os benefícios do Smart',
                    'Personal trainer 2x por mês',
                    'Nutricionista incluso',
                    'Acesso a todas as unidades',
                    'Acesso 24 horas',
                    'Sala VIP',
                    'Convidados ilimitados'
                ],
                'popular' => false
            ]
        ];

        // Dados simulados para demo
        $recentLogs = [];
        $recentUsers = [];
        
        if ($user->isMaster()) {
            $recentLogs = [
                ['user_name' => 'Ana Silva', 'user_login' => 'ANSILI', 'created_at' => now()],
                ['user_name' => 'Carlos Santos', 'user_login' => 'CASANT', 'created_at' => now()->subMinutes(15)],
                ['user_name' => 'Maria Oliveira', 'user_login' => 'MAROLI', 'created_at' => now()->subMinutes(30)],
                ['user_name' => 'João Costa', 'user_login' => 'JOCOST', 'created_at' => now()->subMinutes(45)],
                ['user_name' => 'Fernanda Lima', 'user_login' => 'FERLIM', 'created_at' => now()->subHour()],
            ];
            
            $recentUsers = [
                ['name' => 'Pedro Souza', 'email' => 'pedro@email.com', 'created_at' => now()],
                ['name' => 'Laura Ferreira', 'email' => 'laura@email.com', 'created_at' => now()->subDay()],
                ['name' => 'Rafael Santos', 'email' => 'rafael@email.com', 'created_at' => now()->subDays(2)],
            ];
        }

        return view('dashboard', compact('user', 'stats', 'plans', 'recentLogs', 'recentUsers'));
    }
}
