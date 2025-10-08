<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treinos - FitPlan Academy</title>
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

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary/10 to-primary/5 py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-zinc-900 dark:text-white mb-6">
                    Seus <span class="text-primary">Treinos</span>
                </h1>
                <p class="text-lg text-zinc-600 dark:text-zinc-400 mb-8">
                    Transforme seu corpo com nossos treinos personalizados. 
                    Escolha sua série e comece sua jornada fitness hoje!
                </p>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <!-- Total de Treinos -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Total de Treinos</p>
                            <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $workoutStats['total_workouts'] ?? 0 }}</p>
                        </div>
                        <div class="text-primary">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Treinos Esta Semana -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Esta Semana</p>
                            <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $workoutStats['completed_this_week'] ?? 0 }}</p>
                        </div>
                        <div class="text-green-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Sequência Ativa -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Sequência Ativa</p>
                            <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $workoutStats['streak_days'] ?? 0 }} dias</p>
                        </div>
                        <div class="text-orange-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Tempo Total -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Tempo Total</p>
                            <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $workoutStats['total_minutes'] ?? 0 }} min</p>
                        </div>
                        <div class="text-blue-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Workouts Section -->
    <section class="py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-zinc-900 dark:text-white">Seus Treinos de Hoje</h2>
                <div class="flex items-center gap-2">
                    <span class="text-sm text-zinc-600 dark:text-zinc-400">Filtro:</span>
                    <select class="px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white">
                        <option value="all">Todos</option>
                        <option value="completed">Concluídos</option>
                        <option value="pending">Pendentes</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @foreach($workouts as $workout)
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg overflow-hidden">
                    <!-- Header do Card -->
                    <div class="p-6 border-b border-zinc-200 dark:border-zinc-700">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-bold text-zinc-900 dark:text-white">{{ $workout['name'] }}</h3>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm text-zinc-600 dark:text-zinc-400">{{ $workout['duration'] }} min</span>
                            </div>
                        </div>
                        
                        <p class="text-zinc-600 dark:text-zinc-400 text-sm mb-4">{{ $workout['description'] }}</p>
                        
                        <!-- Tags -->
                        <div class="flex items-center gap-2 mb-4">
                            <span class="px-2 py-1 bg-primary/10 text-primary text-xs font-medium rounded-full">
                                {{ ucfirst($workout['difficulty']) }}
                            </span>
                            @foreach($workout['muscle_groups'] as $group)
                            <span class="px-2 py-1 bg-zinc-100 dark:bg-zinc-700 text-zinc-600 dark:text-zinc-400 text-xs rounded-full">
                                {{ ucfirst($group) }}
                            </span>
                            @endforeach
                        </div>

                        <!-- Progresso -->
                        @if($workout['completion_rate'] > 0)
                        <div class="mb-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-zinc-600 dark:text-zinc-400">Progresso</span>
                                <span class="text-sm font-medium text-zinc-900 dark:text-white">{{ $workout['completion_rate'] }}%</span>
                            </div>
                            <div class="w-full bg-zinc-200 dark:bg-zinc-700 rounded-full h-2">
                                <div class="bg-primary h-2 rounded-full" style="width: {{ $workout['completion_rate'] }}%"></div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Exercícios -->
                    <div class="p-6">
                        <h4 class="font-semibold text-zinc-900 dark:text-white mb-4">Exercícios:</h4>
                        <div class="space-y-3">
                            @foreach($workout['exercises'] as $exercise)
                            <div class="flex items-center justify-between p-3 bg-zinc-50 dark:bg-zinc-700 rounded-lg">
                                <div>
                                    <p class="font-medium text-zinc-900 dark:text-white">{{ $exercise['name'] }}</p>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ $exercise['sets'] }}</p>
                                </div>
                                <span class="text-xs text-zinc-500">{{ $exercise['rest'] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Footer do Card -->
                    <div class="p-6 border-t border-zinc-200 dark:border-zinc-700">
                        @if($workout['completed'])
                        <button class="w-full bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 font-semibold py-3 px-6 rounded-lg flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Concluído
                        </button>
                        @else
                        <button onclick="startWorkout('{{ $workout['id'] }}')" class="w-full bg-primary hover:bg-primary/90 text-white font-semibold py-3 px-6 rounded-lg transition-colors flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h1m4 0h1m-6-8h8a2 2 0 012 2v8a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2z"></path>
                            </svg>
                            Começar Treino
                        </button>
                        @endif
                        
                        @if($workout['last_completed'])
                        <p class="text-xs text-zinc-500 text-center mt-2">
                            Última execução: {{ $workout['last_completed'] }}
                        </p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Recent Workouts Section -->
    <section class="py-12 bg-zinc-50 dark:bg-zinc-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-zinc-900 dark:text-white mb-8">Treinos Recentes</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($recentWorkouts as $recent)
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-zinc-900 dark:text-white">{{ $recent['workout_name'] }}</h3>
                        <div class="flex items-center gap-1">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $recent['rating'])
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-zinc-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-zinc-600 dark:text-zinc-400">Data:</span>
                            <span class="text-sm font-medium text-zinc-900 dark:text-white">{{ $recent['completed_at'] }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-zinc-600 dark:text-zinc-400">Duração:</span>
                            <span class="text-sm font-medium text-zinc-900 dark:text-white">{{ $recent['duration'] }} min</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

<!-- JavaScript para funcionalidades -->
<script>
/**
 * Inicia um treino
 * @param {string} workoutId - ID do treino
 */
function startWorkout(workoutId) {
    // Mostrar loading
    const button = event.target;
    const originalText = button.innerHTML;
    button.innerHTML = '<svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Iniciando...';
    button.disabled = true;

    // Simular chamada AJAX
    fetch(`/workouts/${workoutId}/start`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            workout_id: workoutId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Redirecionar para página do treino
            window.location.href = `/workouts/${workoutId}`;
        } else {
            // Mostrar erro
            alert('Erro ao iniciar treino: ' + data.message);
            button.innerHTML = originalText;
            button.disabled = false;
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert('Erro ao iniciar treino');
        button.innerHTML = originalText;
        button.disabled = false;
    });
}

/**
 * Filtra treinos por status
 */
function filterWorkouts(status) {
    const cards = document.querySelectorAll('.workout-card');
    
    cards.forEach(card => {
        if (status === 'all') {
            card.style.display = 'block';
        } else if (status === 'completed') {
            const button = card.querySelector('button');
            if (button && button.textContent.includes('Concluído')) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        } else if (status === 'pending') {
            const button = card.querySelector('button');
            if (button && button.textContent.includes('Começar')) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        }
    });
}

// Adicionar event listener para o filtro
document.addEventListener('DOMContentLoaded', function() {
    const filterSelect = document.querySelector('select');
    if (filterSelect) {
        filterSelect.addEventListener('change', function() {
            filterWorkouts(this.value);
        });
    }
});
</script>
</body>
</html>
