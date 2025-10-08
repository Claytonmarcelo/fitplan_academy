<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafios - FitPlan Academy</title>
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
                    Desafios <span class="text-primary">Fitness</span>
                </h1>
                <p class="text-lg text-zinc-600 dark:text-zinc-400 mb-8">
                    Supere seus limites e conquiste recompensas incríveis! 
                    Participe dos nossos desafios e transforme sua jornada fitness.
                </p>
            </div>
        </div>
    </section>

    <!-- Active Challenges Section -->
    <section class="py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-zinc-900 dark:text-white mb-8">Desafios Ativos</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @foreach($activeChallenges as $challenge)
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg overflow-hidden">
                    <!-- Header do Card -->
                    <div class="p-6 border-b border-zinc-200 dark:border-zinc-700">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-bold text-zinc-900 dark:text-white">{{ $challenge['name'] }}</h3>
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-1 bg-primary/10 text-primary text-xs font-medium rounded-full">
                                    {{ ucfirst($challenge['difficulty']) }}
                                </span>
                                <span class="px-2 py-1 bg-zinc-100 dark:bg-zinc-700 text-zinc-600 dark:text-zinc-400 text-xs rounded-full">
                                    {{ ucfirst($challenge['category']) }}
                                </span>
                            </div>
                        </div>
                        
                        <p class="text-zinc-600 dark:text-zinc-400 text-sm mb-4">{{ $challenge['description'] }}</p>
                        
                        <!-- Meta -->
                        <div class="bg-zinc-50 dark:bg-zinc-700 rounded-lg p-4 mb-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-zinc-600 dark:text-zinc-400">Meta:</span>
                                <span class="font-bold text-zinc-900 dark:text-white">{{ $challenge['target_value'] }} {{ $challenge['unit'] }}</span>
                            </div>
                        </div>

                        <!-- Recompensa -->
                        <div class="bg-gradient-to-r from-yellow-50 to-orange-50 dark:from-yellow-900/20 dark:to-orange-900/20 rounded-lg p-4 mb-4">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                <span class="text-sm font-medium text-zinc-900 dark:text-white">Recompensa:</span>
                            </div>
                            <p class="text-sm text-zinc-600 dark:text-zinc-400 mt-1">{{ $challenge['reward'] }}</p>
                        </div>

                        <!-- Participantes -->
                        <div class="flex items-center justify-between text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                            <span>{{ $challenge['participants'] }} participantes</span>
                            <span>{{ $challenge['start_date'] }} - {{ $challenge['end_date'] }}</span>
                        </div>
                    </div>

                    <!-- Footer do Card -->
                    <div class="p-6">
                        <button onclick="joinChallenge('{{ $challenge['id'] }}')" class="w-full bg-primary hover:bg-primary/90 text-white font-semibold py-3 px-6 rounded-lg transition-colors flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Participar do Desafio
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- User Challenges Section -->
    <section class="py-12 bg-zinc-50 dark:bg-zinc-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-zinc-900 dark:text-white mb-8">Meus Desafios</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                @foreach($userChallenges as $challenge)
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-zinc-900 dark:text-white">{{ $challenge['challenge_name'] }}</h3>
                        <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 text-xs font-medium rounded-full">
                            Ativo
                        </span>
                    </div>
                    
                    <!-- Progresso -->
                    <div class="mb-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-zinc-600 dark:text-zinc-400">Progresso</span>
                            <span class="text-sm font-medium text-zinc-900 dark:text-white">
                                {{ $challenge['progress'] }}/{{ $challenge['target'] }}
                            </span>
                        </div>
                        <div class="w-full bg-zinc-200 dark:bg-zinc-700 rounded-full h-3">
                            <div class="bg-primary h-3 rounded-full" style="width: {{ ($challenge['progress'] / $challenge['target']) * 100 }}%"></div>
                        </div>
                        <p class="text-xs text-zinc-500 mt-1">{{ $challenge['days_remaining'] }} dias restantes</p>
                    </div>
                    
                    <!-- Botão de Atualizar Progresso -->
                    <button onclick="updateProgress('{{ $challenge['challenge_name'] }}')" class="w-full bg-zinc-100 dark:bg-zinc-700 hover:bg-zinc-200 dark:hover:bg-zinc-600 text-zinc-900 dark:text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                        Atualizar Progresso
                    </button>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Achievements Section -->
    <section class="py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Conquistas -->
                <div>
                    <h2 class="text-2xl font-bold text-zinc-900 dark:text-white mb-8">Suas Conquistas</h2>
                    
                    <div class="space-y-4">
                        @foreach($achievements as $achievement)
                        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                            <div class="flex items-center gap-4">
                                <div class="text-4xl">
                                    {{ $achievement['icon'] }}
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-zinc-900 dark:text-white">{{ $achievement['name'] }}</h3>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ $achievement['description'] }}</p>
                                    @if($achievement['status'] === 'earned')
                                        <p class="text-xs text-green-600 dark:text-green-400 mt-1">
                                            Conquistado em {{ $achievement['earned_at'] }}
                                        </p>
                                    @else
                                        <p class="text-xs text-zinc-500 mt-1">Bloqueado</p>
                                    @endif
                                </div>
                                @if($achievement['status'] === 'earned')
                                    <div class="text-green-500">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                @else
                                    <div class="text-zinc-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Ranking -->
                <div>
                    <h2 class="text-2xl font-bold text-zinc-900 dark:text-white mb-8">Ranking</h2>
                    
                    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                        <div class="space-y-4">
                            @foreach($leaderboard as $position)
                            <div class="flex items-center gap-4 p-3 {{ $position['position'] <= 3 ? 'bg-gradient-to-r from-yellow-50 to-orange-50 dark:from-yellow-900/20 dark:to-orange-900/20 rounded-lg' : '' }}">
                                <div class="flex items-center justify-center w-8 h-8 rounded-full {{ $position['position'] === 1 ? 'bg-yellow-500 text-white' : $position['position'] === 2 ? 'bg-gray-400 text-white' : $position['position'] === 3 ? 'bg-orange-600 text-white' : 'bg-zinc-200 dark:bg-zinc-700 text-zinc-600 dark:text-zinc-400' }}">
                                    {{ $position['position'] }}
                                </div>
                                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-primary text-white font-semibold">
                                    {{ $position['avatar'] }}
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-zinc-900 dark:text-white">{{ $position['name'] }}</p>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ $position['points'] }} pontos</p>
                                </div>
                                @if($position['position'] <= 3)
                                    <div class="text-yellow-500">
                                        @if($position['position'] === 1)
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @elseif($position['position'] === 2)
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @else
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JavaScript para funcionalidades -->
<script>
/**
 * Participa de um desafio
 * @param {string} challengeId - ID do desafio
 */
function joinChallenge(challengeId) {
    const button = event.target;
    const originalText = button.textContent;
    
    // Mostrar loading
    button.textContent = 'Participando...';
    button.disabled = true;

    // Simular chamada AJAX
    fetch(`/challenges/${challengeId}/join`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            challenge_id: challengeId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Atualizar botão
            button.textContent = 'Participando';
            button.classList.remove('bg-primary', 'hover:bg-primary/90');
            button.classList.add('bg-green-100', 'dark:bg-green-900', 'text-green-700', 'dark:text-green-300');
            
            // Mostrar notificação
            showNotification('Você entrou no desafio com sucesso!', 'success');
        } else {
            // Mostrar erro
            showNotification('Erro ao participar do desafio: ' + data.message, 'error');
            button.textContent = originalText;
            button.disabled = false;
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        showNotification('Erro ao participar do desafio', 'error');
        button.textContent = originalText;
        button.disabled = false;
    });
}

/**
 * Atualiza progresso de um desafio
 * @param {string} challengeName - Nome do desafio
 */
function updateProgress(challengeName) {
    const progressValue = prompt(`Digite seu progresso atual para "${challengeName}":`);
    
    if (progressValue === null) return; // Usuário cancelou
    
    const numericValue = parseFloat(progressValue);
    if (isNaN(numericValue) || numericValue < 0) {
        showNotification('Por favor, digite um valor numérico válido', 'error');
        return;
    }

    // Simular chamada AJAX
    fetch('/challenges/update-progress', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            challenge_name: challengeName,
            progress_value: numericValue
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Progresso atualizado com sucesso!', 'success');
            // Recarregar página para mostrar atualizações
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            showNotification('Erro ao atualizar progresso: ' + data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        showNotification('Erro ao atualizar progresso', 'error');
    });
}

/**
 * Mostra notificação para o usuário
 * @param {string} message - Mensagem da notificação
 * @param {string} type - Tipo da notificação (success, error, info)
 */
function showNotification(message, type = 'info') {
    // Criar elemento da notificação
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm ${
        type === 'success' ? 'bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300' :
        type === 'error' ? 'bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300' :
        'bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300'
    }`;
    notification.textContent = message;
    
    // Adicionar ao DOM
    document.body.appendChild(notification);
    
    // Remover após 3 segundos
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Adicionar meta tag CSRF se não existir
document.addEventListener('DOMContentLoaded', function() {
    if (!document.querySelector('meta[name="csrf-token"]')) {
        const meta = document.createElement('meta');
        meta.name = 'csrf-token';
        meta.content = '{{ csrf_token() }}';
        document.head.appendChild(meta);
    }
});
</script>
</body>
</html>
