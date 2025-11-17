<?php

namespace App\Http\Controllers;

use App\Models\AccessLog;
use App\Features\User\Infrastructure\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * SystemLogsController
 * 
 * Controller para gerenciar todos os logs do sistema.
 * Exibe logs de acesso, cadastros, alterações e ações administrativas.
 */
class SystemLogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Exibe todos os logs do sistema
     */
    public function index(Request $request)
    {
        // Verificar se o usuário é administrador
        $user = Auth::user();
        
        if (!$user || !$user->isMaster()) {
            return redirect()->route('student.dashboard')
                            ->with('error', 'Acesso negado. Você não tem permissão para visualizar logs do sistema.');
        }

        // Inicializar query para logs de acesso
        $accessLogsQuery = AccessLog::with('user');

        // Filtros para logs de acesso
        if ($request->filled('user_name')) {
            $accessLogsQuery->where('user_name', 'LIKE', '%' . $request->user_name . '%');
        }

        if ($request->filled('user_cpf')) {
            $accessLogsQuery->where('user_cpf', 'LIKE', '%' . $request->user_cpf . '%');
        }

        if ($request->filled('date_from')) {
            $accessLogsQuery->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $accessLogsQuery->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('successful')) {
            $accessLogsQuery->where('login_successful', $request->successful === '1');
        }

        if ($request->filled('two_factor')) {
            $accessLogsQuery->where('two_factor_used', $request->two_factor === '1');
        }

        // Tipo de log
        $logType = $request->get('type', 'all'); // all, access, registrations, changes

        // Obter logs de acesso
        $accessLogs = $accessLogsQuery->orderBy('created_at', 'desc')->paginate(50);

        // Obter logs de cadastro (usuários criados)
        $registrationLogs = collect();
        if ($logType === 'all' || $logType === 'registrations') {
            $registrationLogs = User::orderBy('created_at', 'desc')
                                    ->limit(50)
                                    ->get()
                                    ->map(function ($user) {
                                        return [
                                            'type' => 'registration',
                                            'user_name' => $user->name,
                                            'user_cpf' => $user->cpf,
                                            'user_login' => $user->login,
                                            'user_email' => $user->email,
                                            'user_role' => $user->role,
                                            'created_at' => $user->created_at,
                                            'ip_address' => null,
                                            'action' => 'Cadastro de novo usuário',
                                        ];
                                    });
        }

        // Estatísticas
        $stats = [
            'total_access_logs' => AccessLog::count(),
            'successful_logins' => AccessLog::where('login_successful', true)->count(),
            'failed_logins' => AccessLog::where('login_successful', false)->count(),
            'total_users' => User::count(),
            'total_registrations_today' => User::whereDate('created_at', today())->count(),
            'total_logins_today' => AccessLog::whereDate('created_at', today())->where('login_successful', true)->count(),
            'total_failed_today' => AccessLog::whereDate('created_at', today())->where('login_successful', false)->count(),
        ];

        // Logs recentes combinados (últimas 24 horas)
        $recentLogs = $this->getRecentCombinedLogs();

        return view('admin.system-logs', compact(
            'accessLogs',
            'registrationLogs',
            'stats',
            'recentLogs',
            'logType'
        ));
    }

    /**
     * Obtém logs recentes combinados (acesso + cadastros)
     */
    private function getRecentCombinedLogs()
    {
        $logs = collect();

        // Logs de acesso das últimas 24 horas
        $accessLogs = AccessLog::where('created_at', '>=', now()->subDay())
                              ->orderBy('created_at', 'desc')
                              ->limit(20)
                              ->get()
                              ->map(function ($log) {
                                  return [
                                      'type' => 'access',
                                      'action' => $log->login_successful ? 'Login realizado' : 'Tentativa de login falhou',
                                      'user_name' => $log->user_name,
                                      'user_login' => $log->user_login,
                                      'ip_address' => $log->ip_address,
                                      'successful' => $log->login_successful,
                                      'two_factor' => $log->two_factor_used,
                                      'created_at' => $log->created_at,
                                  ];
                              });

        // Logs de cadastro das últimas 24 horas
        $registrationLogs = User::where('created_at', '>=', now()->subDay())
                               ->orderBy('created_at', 'desc')
                               ->limit(20)
                               ->get()
                               ->map(function ($user) {
                                   return [
                                       'type' => 'registration',
                                       'action' => 'Novo usuário cadastrado',
                                       'user_name' => $user->name,
                                       'user_login' => $user->login,
                                       'user_role' => $user->role,
                                       'ip_address' => null,
                                       'successful' => true,
                                       'two_factor' => false,
                                       'created_at' => $user->created_at,
                                   ];
                               });

        // Combinar e ordenar por data
        $logs = $accessLogs->merge($registrationLogs)
                          ->sortByDesc('created_at')
                          ->take(30);

        return $logs;
    }

    /**
     * Exporta logs em CSV
     */
    public function export(Request $request)
    {
        if (!Auth::user()->isMaster()) {
            abort(403, 'Apenas administradores podem exportar logs.');
        }

        $accessLogs = AccessLog::query();

        // Aplicar mesmos filtros
        if ($request->filled('user_name')) {
            $accessLogs->where('user_name', 'LIKE', '%' . $request->user_name . '%');
        }

        if ($request->filled('date_from')) {
            $accessLogs->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $accessLogs->whereDate('created_at', '<=', $request->date_to);
        }

        $logs = $accessLogs->orderBy('created_at', 'desc')->get();

        $filename = 'logs-sistema-' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($logs) {
            $file = fopen('php://output', 'w');
            
            // Cabeçalho
            fputcsv($file, [
                'Data/Hora',
                'Usuário',
                'CPF',
                'Login',
                'IP',
                'User Agent',
                '2FA',
                'Status',
                'Tipo'
            ]);

            // Dados
            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->created_at->format('d/m/Y H:i:s'),
                    $log->user_name,
                    $log->user_cpf,
                    $log->user_login,
                    $log->ip_address,
                    $log->user_agent ?? 'N/A',
                    $log->two_factor_used ? 'Sim' : 'Não',
                    $log->login_successful ? 'Sucesso' : 'Falha',
                    'Acesso'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

