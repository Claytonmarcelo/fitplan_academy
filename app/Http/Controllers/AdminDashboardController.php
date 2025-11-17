<?php

namespace App\Http\Controllers;

use App\Features\User\Infrastructure\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * AdminDashboardController
 * 
 * Controller para o painel de administrador.
 * Exibe estatísticas e informações administrativas.
 */
class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Exibe o dashboard do administrador
     */
    public function index(Request $request)
    {
        // Verificar se o usuário é administrador
        $user = Auth::user();
        
        if (!$user || !$user->isMaster()) {
            return redirect()->route('student.dashboard')
                            ->with('error', 'Acesso negado. Você não tem permissão para acessar o painel de administrador.');
        }

        // Estatísticas reais do banco de dados
        $stats = [
            'total_users' => User::count(),
            'active_users' => User::where('is_active', true)->count(),
            'total_logins_today' => $this->getLoginsToday(),
            'failed_logins_today' => $this->getFailedLoginsToday(),
            'total_masters' => User::where('role', 'master')->count(),
            'total_commons' => User::where('role', 'common')->count(),
        ];

        // Usuários recentes (últimos 5)
        $recentUsers = User::orderBy('created_at', 'desc')
                          ->limit(5)
                          ->get()
                          ->map(function ($user) {
                              return [
                                  'id' => $user->id,
                                  'name' => $user->name,
                                  'email' => $user->email,
                                  'login' => $user->login,
                                  'role' => $user->role,
                                  'is_active' => $user->is_active,
                                  'created_at' => $user->created_at->format('d/m/Y H:i'),
                              ];
                          });

        // Logs recentes (se houver tabela de logs)
        $recentLogs = $this->getRecentLogs();

        return view('admin-dashboard', compact('user', 'stats', 'recentUsers', 'recentLogs'));
    }

    /**
     * Obtém o número de logins hoje
     */
    private function getLoginsToday()
    {
        // Se houver tabela de access_logs, usar ela
        if (DB::getSchemaBuilder()->hasTable('access_logs')) {
            return DB::table('access_logs')
                    ->whereDate('created_at', today())
                    ->where('login_successful', true)
                    ->count();
        }
        
        // Caso contrário, retornar 0
        return 0;
    }

    /**
     * Obtém o número de logins falhados hoje
     */
    private function getFailedLoginsToday()
    {
        // Se houver tabela de access_logs, usar ela
        if (DB::getSchemaBuilder()->hasTable('access_logs')) {
            return DB::table('access_logs')
                    ->whereDate('created_at', today())
                    ->where('login_successful', false)
                    ->count();
        }
        
        // Caso contrário, retornar 0
        return 0;
    }

    /**
     * Obtém logs recentes
     */
    private function getRecentLogs()
    {
        // Se houver tabela de access_logs, usar ela
        if (DB::getSchemaBuilder()->hasTable('access_logs')) {
            return DB::table('access_logs')
                    ->orderBy('created_at', 'desc')
                    ->limit(10)
                    ->get()
                    ->map(function ($log) {
                        return [
                            'user_name' => $log->user_name ?? 'Usuário',
                            'user_login' => $log->user_login ?? 'N/A',
                            'login_successful' => $log->login_successful ?? true,
                            'created_at' => \Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:i'),
                        ];
                    });
        }
        
        // Caso contrário, retornar array vazio
        return [];
    }
}

