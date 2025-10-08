<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunidade - FitPlan Academy</title>
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
                    Nossa <span class="text-primary">Comunidade</span>
                </h1>
                <p class="text-lg text-zinc-600 dark:text-zinc-400 mb-8">
                    Conecte-se com outros membros, compartilhe suas conquistas e inspire-se 
                    com histórias de transformação. Juntos somos mais fortes!
                </p>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <!-- Posts Criados -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Posts Criados</p>
                            <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $userStats['posts_created'] ?? 0 }}</p>
                        </div>
                        <div class="text-primary">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Likes Recebidos -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Likes Recebidos</p>
                            <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $userStats['total_likes_received'] ?? 0 }}</p>
                        </div>
                        <div class="text-red-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Seguidores -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Seguidores</p>
                            <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $userStats['followers_count'] ?? 0 }}</p>
                        </div>
                        <div class="text-blue-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Conquistas Compartilhadas -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Conquistas</p>
                            <p class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $userStats['achievements_shared'] ?? 0 }}</p>
                        </div>
                        <div class="text-yellow-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Criar Post -->
                    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Criar Post</h3>
                        <form id="createPostForm">
                            <div class="mb-4">
                                <select name="type" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white">
                                    <option value="text">Texto</option>
                                    <option value="achievement">Conquista</option>
                                    <option value="image">Imagem</option>
                                    <option value="video">Vídeo</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <textarea name="content" rows="4" placeholder="Compartilhe algo com a comunidade..." class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white resize-none"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                Publicar
                            </button>
                        </form>
                    </div>

                    <!-- Tópicos em Alta -->
                    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Tópicos em Alta</h3>
                        <div class="space-y-3">
                            @foreach($trendingTopics as $topic)
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-zinc-600 dark:text-zinc-400">{{ $topic['name'] }}</span>
                                <span class="px-2 py-1 bg-zinc-100 dark:bg-zinc-700 text-zinc-600 dark:text-zinc-400 text-xs rounded-full">
                                    {{ $topic['posts_count'] }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Atividades Recentes -->
                    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Atividades Recentes</h3>
                        <div class="space-y-3">
                            @foreach($recentActivities as $activity)
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-xs font-semibold">
                                    {{ substr($activity['user_name'], 0, 2) }}
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-zinc-900 dark:text-white">
                                        <span class="font-medium">{{ $activity['user_name'] }}</span>
                                        {{ $activity['action'] }}
                                    </p>
                                    <p class="text-xs text-zinc-500">{{ $activity['time'] }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Posts Feed -->
                <div class="lg:col-span-3">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-zinc-900 dark:text-white">Feed da Comunidade</h2>
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-zinc-600 dark:text-zinc-400">Ordenar por:</span>
                            <select class="px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white">
                                <option value="recent">Mais Recentes</option>
                                <option value="popular">Mais Populares</option>
                                <option value="trending">Em Alta</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-6">
                        @foreach($posts as $post)
                        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                            <!-- Header do Post -->
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center font-semibold">
                                    {{ $post['user_avatar'] }}
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-zinc-900 dark:text-white">{{ $post['user_name'] }}</h4>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ $post['created_at'] }}</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    @if($post['type'] === 'achievement')
                                        <span class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-700 dark:text-yellow-300 text-xs font-medium rounded-full">
                                            🏆 Conquista
                                        </span>
                                    @elseif($post['type'] === 'image')
                                        <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 text-xs font-medium rounded-full">
                                            📷 Imagem
                                        </span>
                                    @elseif($post['type'] === 'video')
                                        <span class="px-2 py-1 bg-purple-100 dark:bg-purple-900 text-purple-700 dark:text-purple-300 text-xs font-medium rounded-full">
                                            🎥 Vídeo
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Conteúdo do Post -->
                            <div class="mb-4">
                                <p class="text-zinc-900 dark:text-white leading-relaxed">{{ $post['content'] }}</p>
                            </div>

                            <!-- Interações -->
                            <div class="flex items-center justify-between pt-4 border-t border-zinc-200 dark:border-zinc-700">
                                <div class="flex items-center gap-6">
                                    <!-- Like -->
                                    <button onclick="likePost('{{ $post['id'] }}')" class="flex items-center gap-2 text-zinc-600 dark:text-zinc-400 hover:text-red-500 transition-colors">
                                        <svg class="w-5 h-5 {{ $post['is_liked'] ? 'text-red-500 fill-current' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                        <span class="text-sm">{{ $post['likes_count'] }}</span>
                                    </button>

                                    <!-- Comentário -->
                                    <button onclick="toggleComments('{{ $post['id'] }}')" class="flex items-center gap-2 text-zinc-600 dark:text-zinc-400 hover:text-blue-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                        <span class="text-sm">{{ $post['comments_count'] }}</span>
                                    </button>

                                    <!-- Compartilhar -->
                                    <button class="flex items-center gap-2 text-zinc-600 dark:text-zinc-400 hover:text-green-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                        </svg>
                                        <span class="text-sm">{{ $post['shares_count'] }}</span>
                                    </button>
                                </div>

                                <!-- Ver Detalhes -->
                                <button onclick="viewPost('{{ $post['id'] }}')" class="text-sm text-primary hover:text-primary/80 transition-colors">
                                    Ver detalhes →
                                </button>
                            </div>

                            <!-- Comentários (ocultos por padrão) -->
                            <div id="comments-{{ $post['id'] }}" class="hidden mt-4 pt-4 border-t border-zinc-200 dark:border-zinc-700">
                                <div class="space-y-3 mb-4">
                                    <!-- Comentários existentes seriam carregados aqui -->
                                </div>
                                
                                <!-- Formulário de Comentário -->
                                <form class="flex gap-2" onsubmit="addComment(event, '{{ $post['id'] }}')">
                                    <input type="text" name="comment" placeholder="Escreva um comentário..." class="flex-1 px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white text-sm">
                                    <button type="submit" class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                                        Comentar
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JavaScript para funcionalidades -->
<script>
/**
 * Cria um novo post
 */
document.getElementById('createPostForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = {
        content: formData.get('content'),
        type: formData.get('type')
    };
    
    if (!data.content.trim()) {
        showNotification('Por favor, escreva algo para compartilhar', 'error');
        return;
    }
    
    const button = this.querySelector('button[type="submit"]');
    const originalText = button.textContent;
    
    // Mostrar loading
    button.textContent = 'Publicando...';
    button.disabled = true;
    
    // Simular chamada AJAX
    fetch('/community/create-post', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Post criado com sucesso!', 'success');
            this.reset();
            // Recarregar página para mostrar novo post
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            showNotification('Erro ao criar post: ' + data.message, 'error');
            button.textContent = originalText;
            button.disabled = false;
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        showNotification('Erro ao criar post', 'error');
        button.textContent = originalText;
        button.disabled = false;
    });
});

/**
 * Adiciona like a um post
 * @param {string} postId - ID do post
 */
function likePost(postId) {
    const button = event.target.closest('button');
    const icon = button.querySelector('svg');
    const countSpan = button.querySelector('span');
    
    // Simular chamada AJAX
    fetch(`/community/posts/${postId}/like`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            post_id: postId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Atualizar visual
            if (data.action === 'liked') {
                icon.classList.add('text-red-500', 'fill-current');
                countSpan.textContent = parseInt(countSpan.textContent) + 1;
            } else {
                icon.classList.remove('text-red-500', 'fill-current');
                countSpan.textContent = parseInt(countSpan.textContent) - 1;
            }
        }
    })
    .catch(error => {
        console.error('Erro:', error);
    });
}

/**
 * Alterna exibição de comentários
 * @param {string} postId - ID do post
 */
function toggleComments(postId) {
    const commentsDiv = document.getElementById(`comments-${postId}`);
    commentsDiv.classList.toggle('hidden');
}

/**
 * Adiciona comentário a um post
 * @param {Event} event - Evento do formulário
 * @param {string} postId - ID do post
 */
function addComment(event, postId) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    const content = formData.get('comment');
    
    if (!content.trim()) {
        showNotification('Por favor, escreva um comentário', 'error');
        return;
    }
    
    const button = form.querySelector('button[type="submit"]');
    const originalText = button.textContent;
    
    // Mostrar loading
    button.textContent = 'Comentando...';
    button.disabled = true;
    
    // Simular chamada AJAX
    fetch(`/community/posts/${postId}/comment`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            post_id: postId,
            content: content
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Comentário adicionado!', 'success');
            form.reset();
            // Atualizar contador de comentários
            const commentsButton = document.querySelector(`button[onclick="toggleComments('${postId}')"]`);
            const countSpan = commentsButton.querySelector('span');
            countSpan.textContent = parseInt(countSpan.textContent) + 1;
        } else {
            showNotification('Erro ao adicionar comentário: ' + data.message, 'error');
            button.textContent = originalText;
            button.disabled = false;
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        showNotification('Erro ao adicionar comentário', 'error');
        button.textContent = originalText;
        button.disabled = false;
    });
}

/**
 * Visualiza detalhes de um post
 * @param {string} postId - ID do post
 */
function viewPost(postId) {
    window.location.href = `/community/posts/${postId}`;
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
