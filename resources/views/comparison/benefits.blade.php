<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benefícios e Recursos - FitPlan Academy</title>
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
    @include('components.header-working')

    <!-- Main Content -->
    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header da Página -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-zinc-900 dark:text-white mb-4">Benefícios e Recursos</h1>
            <p class="text-xl text-zinc-600 dark:text-zinc-400 max-w-3xl mx-auto">
                Descubra todos os recursos e benefícios que cada plano oferece para maximizar seus resultados fitness.
            </p>
        </div>

        <!-- Benefícios por Plano -->
        <div class="space-y-12">
            @foreach($plans as $plan)
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg overflow-hidden">
                <!-- Header do Plano -->
                <div class="bg-gradient-to-r from-primary/10 to-primary/5 dark:from-primary/20 dark:to-primary/10 px-6 py-4 border-b border-zinc-200 dark:border-zinc-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $plan['name'] }}</h2>
                            <p class="text-zinc-600 dark:text-zinc-400">{{ $plan['description'] }}</p>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold text-primary">
                                R$ {{ number_format($plan['price'], 2, ',', '.') }}
                            </div>
                            <div class="text-sm text-zinc-500 dark:text-zinc-400">por mês</div>
                        </div>
                    </div>
                </div>

                <!-- Lista de Benefícios -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($benefits[$plan['id']] as $benefit)
                        <div class="flex items-start gap-4 p-4 bg-zinc-50 dark:bg-zinc-700/50 rounded-lg">
                            <div class="text-2xl">{{ $benefit['icon'] }}</div>
                            <div>
                                <h3 class="font-semibold text-zinc-900 dark:text-white mb-1">{{ $benefit['name'] }}</h3>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ $benefit['description'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Botão de Ação -->
                <div class="px-6 py-4 bg-zinc-50 dark:bg-zinc-700/50">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-zinc-600 dark:text-zinc-400">
                            {{ count($benefits[$plan['id']]) }} benefícios inclusos
                        </div>
                        <button class="bg-primary hover:bg-primary/90 text-white font-semibold py-2 px-6 rounded-lg transition-colors">
                            Escolher {{ $plan['name'] }}
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Comparação Visual -->
        <div class="mt-12 bg-white dark:bg-zinc-800 rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700">
                <h2 class="text-2xl font-bold text-zinc-900 dark:text-white">Comparação Visual dos Benefícios</h2>
                <p class="text-zinc-600 dark:text-zinc-400 mt-2">Veja quais recursos cada plano oferece</p>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($plans as $plan)
                    <div class="text-center">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">{{ $plan['name'] }}</h3>
                        
                        <!-- Contador de Benefícios -->
                        <div class="mb-6">
                            <div class="w-20 h-20 mx-auto bg-primary/10 dark:bg-primary/20 rounded-full flex items-center justify-center">
                                <span class="text-2xl font-bold text-primary">{{ count($benefits[$plan['id']]) }}</span>
                            </div>
                            <p class="text-sm text-zinc-600 dark:text-zinc-400 mt-2">Benefícios Inclusos</p>
                        </div>

                        <!-- Lista Resumida -->
                        <div class="space-y-2 text-left">
                            @foreach(array_slice($benefits[$plan['id']], 0, 5) as $benefit)
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-primary"></div>
                                <span class="text-sm text-zinc-600 dark:text-zinc-400">{{ $benefit['name'] }}</span>
                            </div>
                            @endforeach
                            @if(count($benefits[$plan['id']]) > 5)
                            <div class="text-sm text-zinc-500 dark:text-zinc-400 italic">
                                +{{ count($benefits[$plan['id']]) - 5 }} outros benefícios
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Recursos Exclusivos -->
        <div class="mt-12">
            <h2 class="text-3xl font-bold text-zinc-900 dark:text-white text-center mb-8">Recursos Exclusivos</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="text-3xl mb-4">🏋️‍♂️</div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">Equipamentos Premium</h3>
                    <p class="text-zinc-600 dark:text-zinc-400">
                        Acesso aos equipamentos mais modernos e tecnológicos do mercado fitness.
                    </p>
                </div>
                
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="text-3xl mb-4">👨‍⚕️</div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">Suporte Médico</h3>
                    <p class="text-zinc-600 dark:text-zinc-400">
                        Consultas com médicos especialistas em medicina esportiva e nutrição.
                    </p>
                </div>
                
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="text-3xl mb-4">📱</div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">App Personalizado</h3>
                    <p class="text-zinc-600 dark:text-zinc-400">
                        Aplicativo móvel com treinos personalizados e acompanhamento em tempo real.
                    </p>
                </div>
                
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="text-3xl mb-4">🏊‍♂️</div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">Piscina Aquecida</h3>
                    <p class="text-zinc-600 dark:text-zinc-400">
                        Piscina semi-olímpica aquecida para natação e hidroginástica.
                    </p>
                </div>
                
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="text-3xl mb-4">🧘‍♀️</div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">Spa e Relaxamento</h3>
                    <p class="text-zinc-600 dark:text-zinc-400">
                        Área completa de spa com sauna, banho turco e sala de relaxamento.
                    </p>
                </div>
                
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <div class="text-3xl mb-4">👥</div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">Comunidade VIP</h3>
                    <p class="text-zinc-600 dark:text-zinc-400">
                        Acesso exclusivo a eventos, workshops e comunidade de membros premium.
                    </p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="mt-12 text-center">
            <div class="bg-primary/10 dark:bg-primary/20 rounded-xl p-8">
                <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-4">
                    Pronto para aproveitar todos esses benefícios?
                </h3>
                <p class="text-zinc-600 dark:text-zinc-400 mb-6 max-w-2xl mx-auto">
                    Escolha o plano que melhor se adapta aos seus objetivos e comece a desfrutar de todos os recursos da FitPlan Academy.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="bg-primary hover:bg-primary/90 text-white font-semibold py-3 px-8 rounded-lg transition-colors">
                        Começar Agora
                    </a>
                    <a href="{{ route('comparison.index') }}" class="bg-white dark:bg-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-700 text-zinc-900 dark:text-white font-semibold py-3 px-8 rounded-lg transition-colors border border-zinc-300 dark:border-zinc-600">
                        Ver Comparação Completa
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
