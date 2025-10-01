<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $page_title ?? 'Sucesso - FitPlan Academy' }}</title>
    <meta name="description" content="{{ $meta_description ?? 'Sua inscrição foi realizada com sucesso. Bem-vindo à FitPlan Academy!' }}"/>
    
    <!-- Preload critical resources -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link rel="preconnect" href="https://cdn.tailwindcss.com"/>
    
    <!-- Critical CSS inline for performance -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    
    <!-- Tailwind configuration for performance -->
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ff6a00",
                        "background-light": "#f8f7f5",
                        "background-dark": "#23170f",
                        "card-light": "#ffffff",
                        "card-dark": "#1a1a1a",
                        "text-light": "#ffffff",
                        "text-dark": "#1a1a1a",
                        "border-light": "#e5e7eb",
                        "border-dark": "#374151"
                    },
                    fontFamily: {
                        'display': ['Inter', 'system-ui', 'sans-serif']
                    }
                }
            }
        }
    </script>
    
    <!-- Performance optimizations -->
    <style>
        /* Critical CSS for above-the-fold content */
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        .gradient-bg {
            background-image: radial-gradient(circle at 1px 1px, #E5E7EB 1px, transparent 0);
            background-size: 20px 20px;
        }
        
        .dark .gradient-bg {
            background-image: radial-gradient(circle at 1px 1px, #374151 1px, transparent 0);
        }
        
        /* Performance: GPU acceleration for animations */
        .animate-scale {
            transform: translateZ(0);
            will-change: transform;
        }
        
        /* Reduce layout shift */
        .success-card {
            min-height: 400px;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-text-dark dark:text-text-light antialiased">
    <!-- Main container with performance optimizations -->
    <div class="relative min-h-screen flex flex-col">
        <!-- Background pattern (optimized) -->
        <div class="absolute inset-0 z-0 gradient-bg"></div>
        
        <!-- Header -->
        <header class="relative z-10 py-5">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center">
                    <span class="material-symbols-outlined text-primary text-3xl">
                        fitness_center
                    </span>
                    <h1 class="ml-2 text-2xl font-bold text-text-dark dark:text-text-light">FitFlex</h1>
                </div>
            </div>
        </header>
        
        <!-- Main content -->
        <main class="relative z-10 flex-grow flex items-center justify-center">
            <div class="w-full max-w-md mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <!-- Success card with performance optimizations -->
                <div class="success-card bg-card-light dark:bg-card-dark/50 backdrop-blur-sm border border-border-light dark:border-border-dark/50 rounded-xl shadow-lg">
                    <!-- Card content -->
                    <div class="p-8 sm:p-10">
                        <!-- Professional success indicator -->
                        <div class="flex justify-center mb-8">
                            <div class="relative">
                                <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center shadow-lg">
                                    <span class="material-symbols-outlined text-white text-3xl font-bold">
                                        check
                                    </span>
                                </div>
                                <div class="absolute -top-1 -right-1 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-white text-sm">done</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Professional success message -->
                        <div class="text-center mb-8">
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                                Pagamento Confirmado
                            </h1>
                            <p class="text-lg text-gray-600 dark:text-gray-300 mb-2">
                                Sua assinatura foi ativada com sucesso
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Você receberá um email de confirmação em breve
                            </p>
                        </div>
                        
                        <!-- Professional order summary -->
                        <div class="bg-gray-50 dark:bg-gray-800/50 rounded-lg border border-gray-200 dark:border-gray-700 p-6 mb-8">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Resumo da Assinatura</h3>
                                <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-green-600 dark:text-green-400 text-sm">receipt</span>
                                </div>
                            </div>
                            
                            <div class="space-y-3">
                                @if(isset($success['plan_name']))
                                <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-700">
                                    <span class="text-gray-600 dark:text-gray-400">Plano</span>
                                    <span class="font-semibold text-gray-900 dark:text-white">{{ $success['plan_name'] }}</span>
                                </div>
                                @endif
                                
                                @if(isset($success['formatted_price']))
                                <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-700">
                                    <span class="text-gray-600 dark:text-gray-400">Valor</span>
                                    <span class="font-semibold text-gray-900 dark:text-white">{{ $success['formatted_price'] }}</span>
                                </div>
                                @endif
                                
                                @if(isset($success['formatted_date']))
                                <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-700">
                                    <span class="text-gray-600 dark:text-gray-400">Data da compra</span>
                                    <span class="font-semibold text-gray-900 dark:text-white">{{ $success['formatted_date'] }}</span>
                                </div>
                                @endif
                                
                                @if(isset($success['transaction_id']) && $success['transaction_id'] !== 'N/A')
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-600 dark:text-gray-400">ID da transação</span>
                                    <span class="font-mono text-sm text-gray-500 dark:text-gray-400">{{ $success['transaction_id'] }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Professional next steps -->
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-6 mb-8">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                                        <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-lg">rocket_launch</span>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                        Próximos Passos
                                    </h4>
                                    <div class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                                        <div class="flex items-center space-x-2">
                                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                            <span>Acesse sua conta para começar a treinar</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                            <span>Configure seu perfil e objetivos</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                            <span>Explore os treinos personalizados</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Professional action buttons -->
                        <div class="space-y-4">
                            <a class="w-full flex items-center justify-center px-6 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-lg hover:from-orange-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 focus:ring-offset-white dark:focus:ring-offset-gray-800 transition-all duration-300 shadow-lg hover:shadow-xl" 
                               href="{{ $success['account_url'] ?? '/dashboard' }}">
                                <span class="material-symbols-outlined mr-2">dashboard</span>
                                Acessar Dashboard
                            </a>
                            
                            <div class="flex space-x-3">
                                <a class="flex-1 flex items-center justify-center px-4 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200" 
                                   href="/support">
                                    <span class="material-symbols-outlined mr-2 text-sm">help</span>
                                    Suporte
                                </a>
                                <a class="flex-1 flex items-center justify-center px-4 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200" 
                                   href="/">
                                    <span class="material-symbols-outlined mr-2 text-sm">home</span>
                                    Início
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Professional footer -->
                    <div class="border-t border-gray-200 dark:border-gray-700 px-8 sm:px-10 py-6 bg-gray-50/50 dark:bg-gray-900/20 rounded-b-xl">
                        <div class="text-center">
                            <div class="flex items-center justify-center space-x-6 mb-4">
                                <a href="/support" class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400 hover:text-orange-500 transition-colors">
                                    <span class="material-symbols-outlined text-sm">support_agent</span>
                                    <span>Suporte</span>
                                </a>
                                <a href="/faq" class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400 hover:text-orange-500 transition-colors">
                                    <span class="material-symbols-outlined text-sm">help</span>
                                    <span>FAQ</span>
                                </a>
                                <a href="/contact" class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400 hover:text-orange-500 transition-colors">
                                    <span class="material-symbols-outlined text-sm">email</span>
                                    <span>Contato</span>
                                </a>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-500">
                                © 2024 FitPlan Academy. Todos os direitos reservados.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
    </div>
    
    <!-- Performance monitoring (optional) -->
    <script>
        // Track page load performance
        window.addEventListener('load', function() {
            if ('performance' in window) {
                const perfData = performance.getEntriesByType('navigation')[0];
                console.log('Success page loaded in:', perfData.loadEventEnd - perfData.loadEventStart, 'ms');
            }
        });
        
        // Track user interactions for analytics
        document.addEventListener('click', function(e) {
            if (e.target.matches('a[href*="dashboard"]')) {
                console.log('User clicked: Go to account');
            }
        });
    </script>
</body>
</html>
