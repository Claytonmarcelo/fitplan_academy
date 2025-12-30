<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - FitPlan Academy</title>
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
    <?php echo $__env->make('components.accessibility-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <!-- Header -->
    <?php echo $__env->make('components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Dashboard Content -->
    <main class="py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-zinc-900 dark:text-white mb-2">
                            Painel Administrativo
                        </h1>
                        <p class="text-zinc-600 dark:text-zinc-400">
                            Bem-vindo, <?php echo e($user->name ?? 'Administrador'); ?>! Gerencie sua academia e acompanhe o progresso dos alunos.
                        </p>
                    </div>
                    <div class="px-4 py-2 bg-purple-100 dark:bg-purple-900 text-purple-700 dark:text-purple-300 rounded-lg font-semibold">
                        👨‍💼 Administrador
                    </div>
                </div>
            </div>

            <?php if(session('success')): ?>
                <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-green-800 dark:text-green-200"><?php echo e(session('success')); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Total de Usuários</p>
                            <p class="text-2xl font-bold text-zinc-900 dark:text-white"><?php echo e($stats['total_users'] ?? 0); ?></p>
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
                            <p class="text-2xl font-bold text-zinc-900 dark:text-white"><?php echo e($stats['active_users'] ?? 0); ?></p>
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
                            <p class="text-2xl font-bold text-zinc-900 dark:text-white"><?php echo e($stats['total_logins_today'] ?? 0); ?></p>
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
                            <p class="text-2xl font-bold text-zinc-900 dark:text-white"><?php echo e($stats['failed_logins_today'] ?? 0); ?></p>
                        </div>
                        <div class="text-red-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Administradores</p>
                            <p class="text-2xl font-bold text-zinc-900 dark:text-white"><?php echo e($stats['total_masters'] ?? 0); ?></p>
                        </div>
                        <div class="text-purple-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Usuários Comuns</p>
                            <p class="text-2xl font-bold text-zinc-900 dark:text-white"><?php echo e($stats['total_commons'] ?? 0); ?></p>
                        </div>
                        <div class="text-blue-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
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
                        <?php if(isset($recentLogs) && count($recentLogs) > 0): ?>
                            <?php $__currentLoopData = $recentLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex items-center justify-between p-3 bg-zinc-50 dark:bg-zinc-700 rounded-lg">
                                    <div>
                                        <p class="font-medium text-zinc-900 dark:text-white"><?php echo e($log['user_name'] ?? 'Usuário'); ?></p>
                                        <p class="text-sm text-zinc-600 dark:text-zinc-400"><?php echo e($log['user_login'] ?? 'N/A'); ?> - <?php echo e($log['created_at'] ?? 'Agora'); ?></p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <?php if($log['login_successful'] ?? true): ?>
                                            <span class="px-2 py-1 text-xs font-medium bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-full">Sucesso</span>
                                        <?php else: ?>
                                            <span class="px-2 py-1 text-xs font-medium bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 rounded-full">Falha</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="text-center py-8">
                                <p class="text-zinc-600 dark:text-zinc-400">Nenhum log recente encontrado.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Recent Users -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-zinc-900 dark:text-white mb-6">Usuários Recentes</h2>
                    <div class="space-y-4">
                        <?php if(isset($recentUsers) && count($recentUsers) > 0): ?>
                            <?php $__currentLoopData = $recentUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recentUser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex items-center justify-between p-3 bg-zinc-50 dark:bg-zinc-700 rounded-lg">
                                    <div>
                                        <p class="font-medium text-zinc-900 dark:text-white"><?php echo e($recentUser['name'] ?? 'Usuário'); ?></p>
                                        <p class="text-sm text-zinc-600 dark:text-zinc-400"><?php echo e($recentUser['email'] ?? 'email@exemplo.com'); ?></p>
                                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Cadastrado em: <?php echo e($recentUser['created_at'] ?? 'N/A'); ?></p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <?php if($recentUser['role'] === 'master'): ?>
                                            <span class="px-2 py-1 text-xs font-medium bg-purple-100 dark:bg-purple-900 text-purple-700 dark:text-purple-300 rounded-full">Admin</span>
                                        <?php else: ?>
                                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-full">Comum</span>
                                        <?php endif; ?>
                                        <?php if($recentUser['is_active'] ?? true): ?>
                                            <span class="px-2 py-1 text-xs font-medium bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-full">Ativo</span>
                                        <?php else: ?>
                                            <span class="px-2 py-1 text-xs font-medium bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 rounded-full">Inativo</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="text-center py-8">
                                <p class="text-zinc-600 dark:text-zinc-400">Nenhum usuário recente encontrado.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Users Section -->
            <div class="mt-8 bg-white dark:bg-zinc-800 rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-zinc-200 dark:border-zinc-700 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-zinc-900 dark:text-white">Usuários do Sistema</h2>
                    <a href="<?php echo e(route('users.index')); ?>" class="text-sm text-primary hover:text-primary/80 font-medium">
                        Ver todos →
                    </a>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-zinc-50 dark:bg-zinc-700">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase">Nome</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase">Email</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase">Login</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase">Tipo</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                                <?php $__empty_1 = true; $__currentLoopData = $allUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700 transition-colors">
                                    <td class="px-4 py-3 text-sm font-medium text-zinc-900 dark:text-zinc-200"><?php echo e($userItem->name); ?></td>
                                    <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-400"><?php echo e($userItem->email); ?></td>
                                    <td class="px-4 py-3 text-sm">
                                        <code class="px-2 py-1 bg-zinc-100 dark:bg-zinc-700 rounded text-zinc-900 dark:text-zinc-200"><?php echo e($userItem->login); ?></code>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?php if($userItem->role === 'master'): ?>
                                            <span class="px-2 py-1 text-xs font-medium bg-purple-100 dark:bg-purple-900 text-purple-700 dark:text-purple-300 rounded-full">Admin</span>
                                        <?php else: ?>
                                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-full">Comum</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?php if($userItem->is_active): ?>
                                            <span class="px-2 py-1 text-xs font-medium bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-full">Ativo</span>
                                        <?php else: ?>
                                            <span class="px-2 py-1 text-xs font-medium bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 rounded-full">Inativo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <a href="<?php echo e(route('users.edit', $userItem)); ?>" class="text-primary hover:text-primary/80 font-medium">
                                            ✏️ Editar
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center text-zinc-600 dark:text-zinc-400">
                                        Nenhum usuário encontrado.
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Plans Section -->
            <div class="mt-8 bg-white dark:bg-zinc-800 rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-zinc-200 dark:border-zinc-700 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-zinc-900 dark:text-white">Planos da Academia</h2>
                    <a href="<?php echo e(route('admin.plans.index')); ?>" class="text-sm text-primary hover:text-primary/80 font-medium">
                        Gerenciar →
                    </a>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <?php $__empty_1 = true; $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $planItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="border border-zinc-200 dark:border-zinc-700 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-lg font-bold text-zinc-900 dark:text-white"><?php echo e($planItem->name); ?></h3>
                                <?php if($planItem->is_active): ?>
                                    <span class="px-2 py-1 text-xs font-medium bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-full">Ativo</span>
                                <?php else: ?>
                                    <span class="px-2 py-1 text-xs font-medium bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 rounded-full">Inativo</span>
                                <?php endif; ?>
                            </div>
                            <p class="text-2xl font-bold text-primary mb-2">
                                R$ <?php echo e(number_format($planItem->price, 2, ',', '.')); ?>

                            </p>
                            <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-3"><?php echo e($planItem->description); ?></p>
                            <a href="<?php echo e(route('admin.plans.edit', $planItem)); ?>" class="text-sm text-primary hover:text-primary/80 font-medium">
                                ✏️ Editar Preço →
                            </a>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-span-3 text-center py-8 text-zinc-600 dark:text-zinc-400">
                            Nenhum plano encontrado.
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-8">
                <h2 class="text-xl font-bold text-zinc-900 dark:text-white mb-6">Ações Rápidas</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <a href="<?php echo e(route('users.index')); ?>" class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
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

                    <a href="<?php echo e(route('system-logs.index')); ?>" class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                        <div class="flex items-center gap-4">
                            <div class="text-blue-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-zinc-900 dark:text-white">Logs do Sistema</h3>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">Visualizar todas as atividades do sistema</p>
                            </div>
                        </div>
                    </a>

                    <a href="<?php echo e(route('users.pdf')); ?>" class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
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

<?php /**PATH /Users/eduardocruz/fitplan_acadamy/resources/views/admin-dashboard.blade.php ENDPATH**/ ?>