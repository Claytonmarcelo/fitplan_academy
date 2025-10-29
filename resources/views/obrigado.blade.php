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
    <!-- Barra de Acessibilidade -->
    @include('components.accessibility-bar')
    <!-- Layout conforme design fornecido -->
    <div class="flex flex-col min-h-screen">
        <!-- Header simples com borda -->
        <header class="border-b border-primary/20 dark:border-primary/30">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <span class="material-symbols-outlined text-primary text-3xl">
                            fitness_center
                        </span>
                        <h1 class="ml-2 text-2xl font-bold text-gray-900 dark:text-white">FitFlex</h1>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main centralizado -->
        <main class="flex-grow flex items-center justify-center">
            <div class="text-center max-w-lg mx-auto p-8">
                <div class="flex justify-center mb-6">
                    <div class="bg-primary/10 dark:bg-primary/20 p-4 rounded-full">
                        <div class="bg-primary/20 dark:bg-primary/30 p-3 rounded-full">
                            <span class="material-symbols-outlined text-primary text-5xl">
                                celebration
                            </span>
                        </div>
                    </div>
                </div>
                <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-4">Obrigado por se juntar!</h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">
                    Sua matrícula foi concluída. Estamos muito felizes em tê-lo na nossa comunidade. Prepare-se para alcançar seus objetivos de fitness com a gente!
                </p>
                <a class="inline-block w-full sm:w-auto px-8 py-3 bg-primary text-white font-bold rounded-lg hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary focus:ring-offset-background-light dark:focus:ring-offset-background-dark transition-colors duration-300" href="{{ $success['account_url'] ?? '/dashboard' }}">
                    Entrar na minha conta
                </a>
            </div>
        </main>

        <!-- Footer -->
        @include('components.footer')
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
