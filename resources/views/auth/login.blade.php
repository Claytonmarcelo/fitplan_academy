<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - FitPlan Academy</title>
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
<body class="bg-background-light dark:bg-background-dark font-display text-zinc-900 dark:text-zinc-200 min-h-screen flex flex-col">
    <!-- Barra de Acessibilidade -->
    @include('components.accessibility-bar')
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-sm border-b border-zinc-200 dark:border-zinc-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('landing') }}" class="flex items-center gap-4">
                    <div class="text-primary size-8">
                        <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path d="M42.1739 20.1739L27.8261 5.82609C29.1366 7.13663 28.3989 10.1876 26.2002 13.7654C24.8538 15.9564 22.9595 18.3449 20.6522 20.6522C18.3449 22.9595 15.9564 24.8538 13.7654 26.2002C10.1876 28.3989 7.13663 29.1366 5.82609 27.8261L20.1739 42.1739C21.4845 43.4845 24.5355 42.7467 28.1133 40.548C30.3042 39.2016 32.6927 37.3073 35 35C37.3073 32.6927 39.2016 30.3042 40.548 28.1133C42.7467 24.5355 43.4845 21.4845 42.1739 20.1739Z" fill="currentColor"></path>
                            <path clip-rule="evenodd" d="M7.24189 26.4066C7.31369 26.4411.64204 26.5637 8.52504 26.3738C9.59462 26.1438 11.0343 25.5311 12.7183 24.4963C14.7583 23.2426 17.0256 21.4503 19.238 19.238C21.4503 17.0256 23.2426 14.7583 24.4963 12.7183C25.5311 11.0343 26.1438 9.59463 26.3738 8.52504C26.5637 7.64204 26.4411 7.31369 26.4066 7.24189C26.345 7.21246 26.143 7.14535 25.6664 7.1918C24.9745 7.25925 23.9954 7.5498 22.7699 8.14278C20.3369 9.32007 17.3369 11.4915 14.4142 14.4142C11.4915 17.3369 9.32007 20.3369 8.14278 22.7699C7.5498 23.9954 7.25925 24.9745 7.1918 25.6664C7.14534 26.143 7.21246 26.345 7.24189 26.4066ZM29.9001 10.7285C29.4519 12.0322 28.7617 13.4172 27.9042 14.8126C26.465 17.1544 24.4686 19.6641 22.0664 22.0664C19.6641 24.4686 17.1544 26.465 14.8126 27.9042C13.4172 28.7617 12.0322 29.4519 10.7285 29.9001L21.5754 40.747C21.6001 40.7606 21.8995 40.931 22.8729 40.7217C23.9424 40.4916 25.3821 39.879 27.0661 38.8441C29.1062 37.5904 31.3734 35.7982 33.5858 33.5858C35.7982 31.3734 37.5904 29.1062 38.8441 27.0661C39.879 25.3821 40.4916 23.9425 40.7216 22.8729C40.931 21.8995 40.7606 21.6001 40.747 21.
5754L29.9001 10.7285ZM29.2403 4.41187L43.5881 18.7597C44.9757 20.1473 44.9743 22.1235 44.6322 23.7139C44.2714 25.3919 43.4158 27.2666 42.252 29.1604C40.8128 31.5022 38.8165 34.012 36.4142 36.4142C34.012 38.8165 31.5022 40.7128 29.1604 42.252C27.2666 43.4158 25.3919 44.2714 23.7139 44.6322C22.1235 44.9743 20.1473 44.9757 18.7597 43.5881L4.41187 29.2403C3.29027 28.1187 3.08209 26.5973 3.21067 25.2783C3.34099 23.9415 3.8369 22.4852 4.54214 21.0277C5.96129 18.0948 8.43335 14.7382 11.5858 11.5858C14.7382 8.43335 18.0948 5.9613 21.0277 4.54214C22.4852 3.8369 23.9415 3.34099 25.2783 3.21067C26.5973 3.08209 28.1187 3.29028 29.2403 4.41187Z" fill="currentColor" fill-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">FitPlan Academy</h1>
                </a>
                <div class="flex items-center gap-2">
                    <a href="{{ route('cadastro') }}" class="px-4 py-2 text-sm font-medium text-zinc-600 dark:text-zinc-300 hover:text-primary transition-colors">Cadastre-se</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 overflow-hidden shadow-lg">
            <div class="p-8">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-zinc-900 dark:text-white mb-2">Entrar</h2>
                    <p class="text-zinc-600 dark:text-zinc-400">Faça login para acessar sua conta</p>
                </div>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg mb-4">
                        <div class="flex items-center">
                            <div class="text-green-500 mr-3">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg mb-4">
                        <div class="flex items-center">
                            <div class="text-red-500 mr-3">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-medium">Ops! Houve alguns problemas com seu envio.</div>
                                <ul class="mt-2 text-sm list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Login Form -->
                <form action="{{ route('auth.login') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Login Field -->
                    <div>
                        <label for="login" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Login</label>
                        <input type="text" 
                               id="login" 
                               name="login" 
                               value="{{ old('login') }}"
                               placeholder="Seu login"
                               class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Senha</label>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               placeholder="Sua senha"
                               class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-3 font-bold text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">
                        Entrar
                    </button>
                </form>

                <!-- Credenciais de Teste -->
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
                    <div class="flex items-start">
                        <div class="text-blue-500 mr-3 mt-0.5">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-sm font-semibold text-blue-900 dark:text-blue-100 mb-2">
                                🔑 Credenciais de Teste Disponíveis
                            </h3>
                            <div class="space-y-2 text-sm">
                                <div class="bg-white dark:bg-blue-800/30 rounded p-3 border border-blue-200 dark:border-blue-700">
                                    <div class="font-medium text-blue-900 dark:text-blue-100 mb-1">👑 Administrador Master</div>
                                    <div class="text-blue-700 dark:text-blue-300">
                                        <strong>Login:</strong> MASTER<br>
                                        <strong>Senha:</strong> MasterPass<br>
                                        <strong>Email:</strong> master@fitplan.com.br
                                    </div>
                                </div>
                                <div class="bg-white dark:bg-blue-800/30 rounded p-3 border border-blue-200 dark:border-blue-700">
                                    <div class="font-medium text-blue-900 dark:text-blue-100 mb-1">👤 Usuário Comum - Sophia</div>
                                    <div class="text-blue-700 dark:text-blue-300">
                                        <strong>Login:</strong> SOPHIA<br>
                                        <strong>Senha:</strong> password<br>
                                        <strong>Email:</strong> sophia@fitplanacademy.com
                                    </div>
                                </div>
                            </div>
                            <p class="text-xs text-blue-600 dark:text-blue-400 mt-2">
                                ✅ <strong>Status:</strong> Todas as credenciais estão funcionando!<br>
                                💡 <strong>Dica:</strong> Clique nos cards acima para preencher automaticamente os campos
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-zinc-200 dark:border-zinc-700"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white dark:bg-zinc-800 text-zinc-500 dark:text-zinc-400">ou</span>
                    </div>
                </div>

                <!-- Register Link -->
                <div class="text-center">
                    <p class="text-sm text-zinc-600 dark:text-zinc-400">
                        Não tem uma conta? 
                        <a href="{{ route('cadastro') }}" class="text-primary hover:underline font-medium">
                            Cadastre-se aqui
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-zinc-100 dark:bg-zinc-900 py-6 text-center text-zinc-600 dark:text-zinc-400 text-sm border-t border-zinc-200 dark:border-zinc-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            &copy; {{ date('Y') }} FitPlan Academy. Todos os direitos reservados.
        </div>
    </footer>

    <!-- JavaScript para correção automática de CSRF -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Função para corrigir token CSRF automaticamente
        function fixCSRFToken() {
            fetch('/login', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newToken = doc.querySelector('meta[name="csrf-token"]');
                if (newToken) {
                    document.querySelector('meta[name="csrf-token"]').setAttribute('content', newToken.getAttribute('content'));
                    document.querySelector('input[name="_token"]').value = newToken.getAttribute('content');
                }
            })
            .catch(error => console.log('Erro ao corrigir token CSRF:', error));
        }

        // Corrigir token CSRF a cada 30 segundos
        setInterval(fixCSRFToken, 30000);

        // Adicionar eventos de clique nas credenciais
        const credentialCards = document.querySelectorAll('.bg-white.dark\\:bg-blue-800\\/30');
        credentialCards.forEach(card => {
            card.style.cursor = 'pointer';
            card.addEventListener('click', function() {
                const cardText = this.textContent;
                
                // Extrair login e senha usando regex
                const loginMatch = cardText.match(/Login:\s*([^\n\r]+)/);
                const passwordMatch = cardText.match(/Senha:\s*([^\n\r]+)/);
                
                if (loginMatch && passwordMatch) {
                    const loginText = loginMatch[1].trim();
                    const passwordText = passwordMatch[1].trim();
                    
                    // Preencher automaticamente os campos
                    const loginField = document.getElementById('login');
                    const passwordField = document.getElementById('password');
                    
                    if (loginField && passwordField) {
                        loginField.value = loginText;
                        passwordField.value = passwordText;
                        
                        // Feedback visual nos campos
                        loginField.style.borderColor = '#10b981';
                        passwordField.style.borderColor = '#10b981';
                        
                        setTimeout(() => {
                            loginField.style.borderColor = '';
                            passwordField.style.borderColor = '';
                        }, 2000);
                        
                        // Feedback visual no card
                        this.style.backgroundColor = '#dcfce7';
                        setTimeout(() => {
                            this.style.backgroundColor = '';
                        }, 1000);
                    }
                }
            });
        });

        // Efeito hover nas credenciais
        credentialCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '';
            });
        });
    });
    </script>
</body>
</html>