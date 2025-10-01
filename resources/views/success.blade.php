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
                        <!-- Success icon with animation -->
                        <div class="flex justify-center mb-6">
                            <div class="bg-green-100 dark:bg-green-900/50 p-3 rounded-full animate-scale">
                                <span class="material-symbols-outlined text-green-600 dark:text-green-400 !text-3xl">
                                    check_circle
                                </span>
                            </div>
                        </div>
                        
                        <!-- Success message -->
                        <h2 class="text-2xl sm:text-3xl font-semibold text-center text-text-dark dark:text-text-light mb-3">
                            {{ $success['title'] ?? 'Inscrição realizada com sucesso!' }}
                        </h2>
                        
                        <p class="text-center text-text-dark/60 dark:text-text-light/60 mb-8">
                            {{ $success['message'] ?? 'Bem-vindo à comunidade FitFlex. Sua conta está pronta.' }}
                        </p>
                        
                        <!-- User details (if available) -->
                        @if(isset($success['user_name']) && !empty($success['user_name']))
                        <div class="bg-background-light dark:bg-background-dark/50 rounded-lg p-4 mb-6">
                            <div class="text-sm text-text-dark/60 dark:text-text-light/60 mb-2">Detalhes da compra:</div>
                            <div class="space-y-1 text-sm">
                                <div><strong>Cliente:</strong> {{ $success['user_name'] }}</div>
                                @if(isset($success['plan_name']))
                                <div><strong>Plano:</strong> {{ $success['plan_name'] }}</div>
                                @endif
                                @if(isset($success['formatted_price']))
                                <div><strong>Valor:</strong> {{ $success['formatted_price'] }}</div>
                                @endif
                                @if(isset($success['transaction_id']) && $success['transaction_id'] !== 'N/A')
                                <div><strong>Transação:</strong> {{ $success['transaction_id'] }}</div>
                                @endif
                                @if(isset($success['formatted_date']))
                                <div><strong>Data:</strong> {{ $success['formatted_date'] }}</div>
                                @endif
                            </div>
                        </div>
                        @endif
                        
                        <!-- Next steps -->
                        @if(isset($success['next_steps']) && !empty($success['next_steps']))
                        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
                            <div class="flex items-start">
                                <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 mr-2 mt-0.5">info</span>
                                <div class="text-sm text-blue-800 dark:text-blue-200">
                                    {{ $success['next_steps'] }}
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <!-- Action button -->
                        <a class="w-full flex items-center justify-center px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary focus:ring-offset-white dark:focus:ring-offset-background-dark transition-all duration-300 transform hover:scale-105 animate-scale" 
                           href="{{ $success['account_url'] ?? '/dashboard' }}">
                            Ir para minha conta
                            <span class="material-symbols-outlined ml-2">
                                arrow_forward
                            </span>
                        </a>
                    </div>
                    
                    <!-- Footer with support -->
                    <div class="border-t border-border-light dark:border-border-dark/50 px-8 sm:px-10 py-4 bg-background-light/50 dark:bg-background-dark/20 rounded-b-xl">
                        <p class="text-sm text-text-dark/60 dark:text-text-light/60 text-center">
                            Precisa de ajuda? 
                            <a class="font-medium text-primary hover:text-primary/80 transition-colors" 
                               href="mailto:{{ $success['support_email'] ?? 'suporte@fitplan.com' }}">
                                Entre em contato
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </main>
        
        <!-- Footer -->
        <footer class="relative z-10 py-6">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p class="text-sm text-text-dark/60 dark:text-text-light/60">
                    © {{ date('Y') }} FitPlan Academy. Todos os direitos reservados.
                </p>
            </div>
        </footer>
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
