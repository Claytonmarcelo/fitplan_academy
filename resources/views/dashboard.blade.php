<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - FitPlan Academy</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ff6a00",
                        "background-light": "#f8f7f5",
                        "background-dark": "#23170f",
                    },
                    fontFamily: {
                        "display": ["Inter"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-zinc-900 dark:text-zinc-200">
<div class="min-h-screen">
    <!-- Barra de Acessibilidade -->
    @include('components.accessibility-bar')
    
    <!-- Header -->
    @include('components.header')

    <!-- Dashboard Content -->
    <main class="py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-zinc-900 dark:text-white mb-2">
                    Bem-vindo, {{ $user->name ?? 'Usuário' }}!
                </h1>
                <p class="text-zinc-600 dark:text-zinc-400">
                    Gerencie sua academia e acompanhe o progresso dos alunos.
                </p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Total de Usuários</p>
                            <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $stats['total_users'] ?? 0 }}</p>
                        </div>
                        <div class="text-primary">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Usuários Ativos</p>
                            <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $stats['active_users'] ?? 0 }}</p>
                        </div>
                        <div class="text-green-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Logins Hoje</p>
                            <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $stats['total_logins_today'] ?? 0 }}</p>
                        </div>
                        <div class="text-blue-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Logins Falhados</p>
                            <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $stats['failed_logins_today'] ?? 0 }}</p>
                        </div>
                        <div class="text-red-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Logs -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-zinc-900 dark:text-white mb-6">Logs Recentes</h2>
                    <div class="space-y-4">
                        @if(isset($recent_logs) && count($recent_logs) > 0)
                            @foreach($recent_logs as $log)
                                <div class="flex items-center justify-between p-3 bg-zinc-50 dark:bg-zinc-700 rounded-lg">
                                    <div>
                                        <p class="font-medium text-zinc-900 dark:text-white">{{ $log['user_name'] ?? 'Usuário' }}</p>
                                        <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ $log['created_at'] ?? 'Agora' }}</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        @if($log['login_successful'] ?? true)
                                            <span class="px-2 py-1 text-xs font-medium bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-full">Sucesso</span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-medium bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 rounded-full">Falha</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-8">
                                <p class="text-zinc-600 dark:text-zinc-400">Nenhum log recente encontrado.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Recent Users -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-zinc-900 dark:text-white mb-6">Usuários Recentes</h2>
                    <div class="space-y-4">
                        @if(isset($recent_users) && count($recent_users) > 0)
                            @foreach($recent_users as $user)
                                <div class="flex items-center justify-between p-3 bg-zinc-50 dark:bg-zinc-700 rounded-lg">
                                    <div>
                                        <p class="font-medium text-zinc-900 dark:text-white">{{ $user['name'] ?? 'Usuário' }}</p>
                                        <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ $user['email'] ?? 'email@exemplo.com' }}</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        @if($user['profile'] ?? 'comum' === 'master')
                                            <span class="px-2 py-1 text-xs font-medium bg-purple-100 dark:bg-purple-900 text-purple-700 dark:text-purple-300 rounded-full">Master</span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-full">Comum</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-8">
                                <p class="text-zinc-600 dark:text-zinc-400">Nenhum usuário recente encontrado.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-8">
                <h2 class="text-xl font-bold text-zinc-900 dark:text-white mb-6">Ações Rápidas</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <a href="{{ route('users.index') }}" class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                        <div class="flex items-center gap-4">
                            <div class="text-primary">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-zinc-900 dark:text-white">Gerenciar Usuários</h3>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">Visualizar e editar usuários</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('access-logs') }}" class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                        <div class="flex items-center gap-4">
                            <div class="text-blue-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-zinc-900 dark:text-white">Logs de Acesso</h3>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">Visualizar histórico de acessos</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('users.pdf') }}" class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                        <div class="flex items-center gap-4">
                            <div class="text-green-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-zinc-900 dark:text-white">Exportar PDF</h3>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">Gerar relatório de usuários</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>