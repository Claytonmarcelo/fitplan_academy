<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>FitPlan Academy - Pagamento Confirmado</title>
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
                        "primary": "#ff6a00",
                        "background-light": "#f8f7f5",
                        "background-dark": "#1a1a1a",
                        "text-light": "#f8f7f5",
                        "text-dark": "#23170f",
                        "card-light": "#ffffff",
                        "card-dark": "#2c2c2c",
                        "border-light": "#e5e7eb",
                        "border-dark": "#3c3c3c",
                    },
                    fontFamily: {
                        "display": ["Inter"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "0.75rem",
                        "xl": "1rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-text-dark dark:text-text-light">
    <!-- Barra de Acessibilidade -->
    @include('components.accessibility-bar')
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full">
            <!-- Card de Sucesso -->
            <div class="bg-card-light dark:bg-card-dark rounded-xl shadow-lg p-8 text-center">
                <!-- Ícone de Sucesso -->
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 dark:bg-green-900 mb-6">
                    <span class="material-symbols-outlined text-green-600 dark:text-green-400 text-3xl">check_circle</span>
                </div>
                
                <!-- Título -->
                <h1 class="text-2xl font-bold text-text-dark dark:text-text-light mb-4">
                    Pagamento Confirmado!
                </h1>
                
                <!-- Mensagem -->
                <p class="text-text-dark/70 dark:text-text-light/70 mb-6">
                    {{ $message ?? 'Seu pagamento foi processado com sucesso. Bem-vindo ao FitPlan Academy!' }}
                </p>
                
                <!-- Detalhes do Checkout -->
                <div class="bg-background-light dark:bg-background-dark rounded-lg p-4 mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-text-dark/70 dark:text-text-light/70">ID do Checkout:</span>
                        <span class="text-sm font-mono text-text-dark dark:text-text-light">#{{ $checkout_id }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-text-dark/70 dark:text-text-light/70">Data:</span>
                        <span class="text-sm text-text-dark dark:text-text-light">{{ now()->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
                
                <!-- Botões de Ação -->
                <div class="space-y-3">
                    <a href="{{ route('login') }}" 
                       class="w-full bg-primary text-white py-3 px-4 rounded-lg font-semibold hover:bg-primary/90 transition-colors inline-block">
                        Fazer Login
                    </a>
                    
                    <a href="{{ route('landing') }}" 
                       class="w-full bg-background-light dark:bg-background-dark text-text-dark dark:text-text-light py-3 px-4 rounded-lg font-semibold hover:bg-background-light/80 dark:hover:bg-background-dark/80 transition-colors inline-block">
                        Voltar ao Início
                    </a>
                </div>
                
                <!-- Informações Adicionais -->
                <div class="mt-8 pt-6 border-t border-border-light dark:border-border-dark">
                    <p class="text-xs text-text-dark/60 dark:text-text-light/60 mb-2">
                        Você receberá um email de confirmação em breve.
                    </p>
                    <p class="text-xs text-text-dark/60 dark:text-text-light/60">
                        Em caso de dúvidas, entre em contato conosco.
                    </p>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="text-center mt-8">
                <p class="text-sm text-text-dark/60 dark:text-text-light/60">
                    © 2024 FitPlan Academy. Todos os direitos reservados.
                </p>
            </div>
        </div>
    </div>
</body>
</html>