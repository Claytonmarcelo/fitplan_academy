<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>FitPlan Academy - Dashboard do Aluno</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ff6b35",
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
            },
        }
    </script>
    <style>
        /* CSS adicional para garantir que as cores funcionem */
        .bg-background-light {
            background-color: #f8f7f5;
        }
        .bg-background-dark {
            background-color: #23170f;
        }
        .text-primary {
            color: #ff6b35;
        }
        .bg-primary {
            background-color: #ff6b35;
        }
        .border-primary {
            border-color: #ff6b35;
        }
        .hover\\:bg-primary\\/90:hover {
            background-color: rgba(255, 107, 53, 0.9);
        }
        .hover\\:text-primary:hover {
            color: #ff6b35;
        }
        .hover\\:border-primary\\/30:hover {
            border-color: rgba(255, 107, 53, 0.3);
        }
        .hover\\:border-primary\\/40:hover {
            border-color: rgba(255, 107, 53, 0.4);
        }
    </style>
    <style>
        .sparkline {
            width: 100%;
            height: 50px;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-zinc-900 dark:text-zinc-100">
    <!-- Header -->
    @include('components.header')

    <div class="flex flex-col min-h-screen">

        <main class="flex-grow">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
                <h2 class="text-4xl font-bold tracking-tight text-zinc-900 dark:text-white mb-8">
                    Olá, {{ explode(' ', $user->name)[0] }}
                </h2>

                @if(session('success'))
                    <div class="mb-6 bg-green-100 dark:bg-green-900 border border-green-400 text-green-700 dark:text-green-200 px-4 py-3 rounded-lg relative" role="alert">
                        <span class="material-symbols-outlined mr-2">check_circle</span>
                        {{ session('success') }}
                        <button onclick="this.parentElement.remove()" class="absolute top-0 right-0 mt-2 mr-2">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </button>
                    </div>
                @endif

                <!-- Cards de Estatísticas -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    
                    <!-- Frequência do Mês -->
                    <div class="bg-white/50 dark:bg-zinc-900/50 backdrop-blur-sm border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 flex flex-col justify-between hover:shadow-lg hover:border-primary/30 dark:hover:border-primary/40 transition-all duration-300">
                        <div>
                            <div class="flex items-center gap-3 mb-1">
                                <span class="material-symbols-outlined text-primary">calendar_month</span>
                                <h3 class="text-lg font-semibold text-zinc-800 dark:text-zinc-200">Frequência do mês</h3>
                            </div>
                            <p class="text-3xl font-bold text-zinc-900 dark:text-white">
                                {{ $stats['frequency_this_month'] ?? 12 }}
                                <span class="text-base font-medium text-zinc-500 dark:text-zinc-400">/20 dias</span>
                            </p>
                        </div>
                        <div class="mt-4">
                            <svg class="sparkline" viewBox="0 0 100 30" xmlns="http://www.w3.org/2000/svg">
                                <path d="M 0 25 L 10 20 L 20 22 L 30 15 L 40 18 L 50 12 L 60 8 L 70 15 L 80 10 L 90 18 L 100 15" fill="none" stroke="hsl(24.7 100% 50% / 0.2)" stroke-width="2"></path>
                                <path d="M 0 25 L 10 20 L 20 22 L 30 15 L 40 18 L 50 12 L 60 8 L 70 15 L 80 10 L 90 18 L 100 15" fill="none" stroke="hsl(24.7 100% 50%)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Próximo Vencimento -->
                    <div class="bg-white/50 dark:bg-zinc-900/50 backdrop-blur-sm border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 flex flex-col justify-between hover:shadow-lg hover:border-primary/30 dark:hover:border-primary/40 transition-all duration-300">
                        <div>
                            <div class="flex items-center gap-3 mb-1">
                                <span class="material-symbols-outlined text-primary">event_upcoming</span>
                                <h3 class="text-lg font-semibold text-zinc-800 dark:text-zinc-200">Próximo vencimento</h3>
                            </div>
                            <p class="text-3xl font-bold text-zinc-900 dark:text-white">
                                {{ date('d') + 10 }} de {{ date('M', strtotime('+1 month')) }}
                            </p>
                        </div>
                        <div class="mt-4">
                            <svg class="sparkline" viewBox="0 0 100 30" xmlns="http://www.w3.org/2000/svg">
                                <path d="M 0 10 L 10 12 L 20 8 L 30 15 L 40 13 L 50 18 L 60 15 L 70 20 L 80 18 L 90 22 L 100 20" fill="none" stroke="hsl(24.7 100% 50% / 0.2)" stroke-width="2"></path>
                                <path d="M 0 10 L 10 12 L 20 8 L 30 15 L 40 13 L 50 18 L 60 15 L 70 20 L 80 18 L 90 22 L 100 20" fill="none" stroke="hsl(24.7 100% 50%)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Progresso de Metas -->
                    <div class="bg-white/50 dark:bg-zinc-900/50 backdrop-blur-sm border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 flex flex-col justify-between hover:shadow-lg hover:border-primary/30 dark:hover:border-primary/40 transition-all duration-300">
                        <div>
                            <div class="flex items-center gap-3 mb-1">
                                <span class="material-symbols-outlined text-primary">trending_up</span>
                                <h3 class="text-lg font-semibold text-zinc-800 dark:text-zinc-200">Progresso de metas</h3>
                            </div>
                            <p class="text-3xl font-bold text-zinc-900 dark:text-white">
                                {{ $stats['goal_progress'] ?? 75 }}%
                            </p>
                        </div>
                        <div class="mt-4">
                            <svg class="sparkline" viewBox="0 0 100 30" xmlns="http://www.w3.org/2000/svg">
                                <path d="M 0 28 L 10 25 L 20 22 L 30 18 L 40 15 L 50 12 L 60 10 L 70 8 L 80 5 L 90 3 L 100 2" fill="none" stroke="hsl(24.7 100% 50% / 0.2)" stroke-width="2"></path>
                                <path d="M 0 28 L 10 25 L 20 22 L 30 18 L 40 15 L 50 12 L 60 10 L 70 8 L 80 5 L 90 3 L 100 2" fill="none" stroke="hsl(24.7 100% 50%)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Seus Treinos de Hoje -->
                <h3 class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-white mb-6">Seus Treinos de Hoje</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    <!-- Série A - Pernas -->
                    <div class="bg-white/50 dark:bg-zinc-900/50 backdrop-blur-sm border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 flex flex-col hover:shadow-lg hover:border-primary/30 dark:hover:border-primary/40 transition-all duration-300">
                        <div class="flex-grow">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-xl font-bold text-zinc-800 dark:text-zinc-200">Série A - Pernas</h4>
                                <div class="flex items-center gap-2 text-sm text-zinc-500 dark:text-zinc-400">
                                    <span class="material-symbols-outlined text-base">timer</span>
                                    <span>45 min</span>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between text-zinc-700 dark:text-zinc-300">
                                    <p>Agachamento Livre</p>
                                    <p class="font-medium">3x12</p>
                                </div>
                                <div class="flex items-center justify-between text-zinc-700 dark:text-zinc-300">
                                    <p>Leg Press 45º</p>
                                    <p class="font-medium">4x10</p>
                                </div>
                                <div class="flex items-center justify-between text-zinc-700 dark:text-zinc-300">
                                    <p>Cadeira Extensora</p>
                                    <p class="font-medium">4x15</p>
                                </div>
                                <div class="flex items-center justify-between text-zinc-700 dark:text-zinc-300">
                                    <p>Panturrilha Sentado</p>
                                    <p class="font-medium">4x20</p>
                                </div>
                            </div>
                        </div>
                        <button onclick="startWorkout('workout_a')" class="mt-6 w-full bg-primary text-white font-bold py-3 px-4 rounded-lg hover:bg-primary/90 transition-colors flex items-center justify-center gap-2">
                            <span>Começar Treino</span>
                            <span class="material-symbols-outlined">play_arrow</span>
                        </button>
                    </div>

                    <!-- Série B - Peito e Tríceps -->
                    <div class="bg-white/50 dark:bg-zinc-900/50 backdrop-blur-sm border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 flex flex-col hover:shadow-lg hover:border-primary/30 dark:hover:border-primary/40 transition-all duration-300">
                        <div class="flex-grow">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-xl font-bold text-zinc-800 dark:text-zinc-200">Série B - Peito e Tríceps</h4>
                                <div class="flex items-center gap-2 text-sm text-zinc-500 dark:text-zinc-400">
                                    <span class="material-symbols-outlined text-base">timer</span>
                                    <span>50 min</span>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between text-zinc-700 dark:text-zinc-300">
                                    <p>Supino Reto</p>
                                    <p class="font-medium">4x8</p>
                                </div>
                                <div class="flex items-center justify-between text-zinc-700 dark:text-zinc-300">
                                    <p>Crucifixo Inclinado</p>
                                    <p class="font-medium">3x12</p>
                                </div>
                                <div class="flex items-center justify-between text-zinc-700 dark:text-zinc-300">
                                    <p>Tríceps Pulley</p>
                                    <p class="font-medium">4x10</p>
                                </div>
                                <div class="flex items-center justify-between text-zinc-700 dark:text-zinc-300">
                                    <p>Mergulho no Banco</p>
                                    <p class="font-medium">3x15</p>
                                </div>
                            </div>
                        </div>
                        <button class="mt-6 w-full bg-zinc-200 dark:bg-zinc-700 text-zinc-600 dark:text-zinc-300 font-bold py-3 px-4 rounded-lg hover:bg-zinc-300 dark:hover:bg-zinc-600 transition-colors flex items-center justify-center gap-2 cursor-not-allowed">
                            <span>Concluído</span>
                            <span class="material-symbols-outlined">check_circle</span>
                        </button>
                    </div>

                    <!-- Série C - Costas e Bíceps -->
                    <div class="bg-white/50 dark:bg-zinc-900/50 backdrop-blur-sm border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 flex flex-col hover:shadow-lg hover:border-primary/30 dark:hover:border-primary/40 transition-all duration-300">
                        <div class="flex-grow">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-xl font-bold text-zinc-800 dark:text-zinc-200">Série C - Costas e Bíceps</h4>
                                <div class="flex items-center gap-2 text-sm text-zinc-500 dark:text-zinc-400">
                                    <span class="material-symbols-outlined text-base">timer</span>
                                    <span>45 min</span>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between text-zinc-700 dark:text-zinc-300">
                                    <p>Barra Fixa</p>
                                    <p class="font-medium">3xFalha</p>
                                </div>
                                <div class="flex items-center justify-between text-zinc-700 dark:text-zinc-300">
                                    <p>Remada Curvada</p>
                                    <p class="font-medium">4x10</p>
                                </div>
                                <div class="flex items-center justify-between text-zinc-700 dark:text-zinc-300">
                                    <p>Puxada Alta</p>
                                    <p class="font-medium">3x12</p>
                                </div>
                                <div class="flex items-center justify-between text-zinc-700 dark:text-zinc-300">
                                    <p>Rosca Direta</p>
                                    <p class="font-medium">4x12</p>
                                </div>
                            </div>
                        </div>
                        <button onclick="startWorkout('workout_c')" class="mt-6 w-full bg-primary text-white font-bold py-3 px-4 rounded-lg hover:bg-primary/90 transition-colors flex items-center justify-center gap-2">
                            <span>Começar Treino</span>
                            <span class="material-symbols-outlined">play_arrow</span>
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Auto-dismiss notifications
        setTimeout(function() {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                if (alert.classList.contains('bg-green-100') || alert.classList.contains('bg-green-900')) {
                    setTimeout(() => {
                        alert.remove();
                    }, 5000);
                }
            });
        }, 100);

        // Função para iniciar treino
        function startWorkout(workoutId) {
            // Redirecionar para página de execução do treino
            window.location.href = `/workouts/${workoutId}/execute`;
        }
    </script>
</body>
</html>
