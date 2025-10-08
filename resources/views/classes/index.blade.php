<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aulas - FitPlan Academy</title>
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
                    Nossas <span class="text-primary">Aulas</span>
                </h1>
                <p class="text-lg text-zinc-600 dark:text-zinc-400 mb-8">
                    Participe de aulas especializadas com instrutores qualificados. 
                    Diversas modalidades para todos os níveis e objetivos.
                </p>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <!-- Total de Aulas -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Aulas Participadas</p>
                            <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $classStats['total_classes_attended'] ?? 0 }}</p>
                        </div>
                        <div class="text-primary">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Aulas Este Mês -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Este Mês</p>
                            <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $classStats['classes_this_month'] ?? 0 }}</p>
                        </div>
                        <div class="text-green-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Taxa de Presença -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Taxa de Presença</p>
                            <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $classStats['attendance_rate'] ?? 0 }}%</p>
                        </div>
                        <div class="text-blue-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Sequência Semanal -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Sequência Semanal</p>
                            <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $classStats['streak_weeks'] ?? 0 }} semanas</p>
                        </div>
                        <div class="text-orange-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Schedule Section -->
    <section class="py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cronograma do Usuário -->
                <div class="lg:col-span-2">
                    <h2 class="text-2xl font-bold text-zinc-900 dark:text-white mb-8">Seu Cronograma</h2>
                    
                    <!-- Aulas de Hoje -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Hoje</h3>
                        <div class="space-y-4">
                            @if(isset($userSchedule['today']) && count($userSchedule['today']) > 0)
                                @foreach($userSchedule['today'] as $class)
                                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="font-semibold text-zinc-900 dark:text-white">{{ $class['class_name'] }}</h4>
                                            <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ $class['instructor'] }} • {{ $class['room'] }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-lg font-bold text-primary">{{ $class['time'] }}</p>
                                            <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 text-xs font-medium rounded-full">
                                                Inscrito
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6 text-center">
                                    <p class="text-zinc-600 dark:text-zinc-400">Nenhuma aula agendada para hoje</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Cronograma da Semana -->
                    <div>
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Esta Semana</h3>
                        <div class="space-y-4">
                            @foreach($userSchedule['this_week'] as $day)
                            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                                <h4 class="font-semibold text-zinc-900 dark:text-white mb-3">{{ $day['day'] }}</h4>
                                <div class="space-y-2">
                                    @foreach($day['classes'] as $class)
                                    <div class="flex items-center justify-between p-3 bg-zinc-50 dark:bg-zinc-700 rounded-lg">
                                        <span class="font-medium text-zinc-900 dark:text-white">{{ $class['name'] }}</span>
                                        <span class="text-sm text-zinc-600 dark:text-zinc-400">{{ $class['time'] }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-8">
                    <!-- Aulas Disponíveis -->
                    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Aulas Disponíveis</h3>
                        <div class="space-y-4">
                            @foreach($classes as $class)
                            <div class="border border-zinc-200 dark:border-zinc-700 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="font-semibold text-zinc-900 dark:text-white">{{ $class['name'] }}</h4>
                                    <span class="px-2 py-1 bg-primary/10 text-primary text-xs font-medium rounded-full">
                                        {{ ucfirst($class['difficulty']) }}
                                    </span>
                                </div>
                                
                                <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-3">{{ $class['description'] }}</p>
                                
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span class="text-sm text-zinc-600 dark:text-zinc-400">{{ $class['instructor'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="text-sm text-zinc-600 dark:text-zinc-400">{{ $class['duration'] }} min</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <span class="text-sm text-zinc-600 dark:text-zinc-400">{{ $class['enrolled_students'] }}/{{ $class['max_students'] }} alunos</span>
                                    </div>
                                </div>
                                
                                <button onclick="enrollInClass('{{ $class['id'] }}')" class="w-full bg-primary hover:bg-primary/90 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                    Inscrever-se
                                </button>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Estatísticas -->
                    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Suas Estatísticas</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-zinc-600 dark:text-zinc-400">Instrutor Favorito</span>
                                <span class="font-medium text-zinc-900 dark:text-white">{{ $classStats['favorite_instructor'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-zinc-600 dark:text-zinc-400">Aula Favorita</span>
                                <span class="font-medium text-zinc-900 dark:text-white">{{ $classStats['favorite_class'] ?? 'N/A' }}</span>
                            </div>
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
 * Inscreve usuário em uma aula
 * @param {string} classId - ID da aula
 */
function enrollInClass(classId) {
    const button = event.target;
    const originalText = button.textContent;
    
    // Mostrar loading
    button.textContent = 'Inscrevendo...';
    button.disabled = true;

    // Simular chamada AJAX
    fetch(`/classes/${classId}/enroll`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            class_id: classId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Atualizar botão
            button.textContent = 'Inscrito';
            button.classList.remove('bg-primary', 'hover:bg-primary/90');
            button.classList.add('bg-green-100', 'dark:bg-green-900', 'text-green-700', 'dark:text-green-300');
            
            // Mostrar notificação
            showNotification('Inscrição realizada com sucesso!', 'success');
        } else {
            // Mostrar erro
            showNotification('Erro ao inscrever-se: ' + data.message, 'error');
            button.textContent = originalText;
            button.disabled = false;
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        showNotification('Erro ao inscrever-se', 'error');
        button.textContent = originalText;
        button.disabled = false;
    });
}

/**
 * Cancela inscrição em uma aula
 * @param {string} classId - ID da aula
 */
function cancelEnrollment(classId) {
    if (!confirm('Tem certeza que deseja cancelar sua inscrição?')) {
        return;
    }

    const button = event.target;
    const originalText = button.textContent;
    
    // Mostrar loading
    button.textContent = 'Cancelando...';
    button.disabled = true;

    // Simular chamada AJAX
    fetch(`/classes/${classId}/cancel`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            class_id: classId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Atualizar botão
            button.textContent = 'Inscrever-se';
            button.classList.remove('bg-green-100', 'dark:bg-green-900', 'text-green-700', 'dark:text-green-300');
            button.classList.add('bg-primary', 'hover:bg-primary/90', 'text-white');
            
            // Mostrar notificação
            showNotification('Inscrição cancelada com sucesso!', 'success');
        } else {
            // Mostrar erro
            showNotification('Erro ao cancelar inscrição: ' + data.message, 'error');
            button.textContent = originalText;
            button.disabled = false;
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        showNotification('Erro ao cancelar inscrição', 'error');
        button.textContent = originalText;
        button.disabled = false;
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
