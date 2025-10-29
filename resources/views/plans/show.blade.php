<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Plano {{ $currentPlan->name }} - FitPlan Academy</title>
    <link href="{{ asset('favicon.ico') }}" rel="icon" type="image/x-icon"/>
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
            },
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
    @include('components.header')

    <main>
        <!-- Hero Section do Plano -->
        <section class="py-16 md:py-24 {{ $currentPlan->name === 'Smart' ? 'bg-orange-500' : 'bg-white dark:bg-zinc-800' }} {{ $currentPlan->name === 'Smart' ? 'text-white' : '' }}">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="flex flex-col gap-6">
                        @if($currentPlan->name === 'Smart')
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/20 rounded-full text-sm font-medium mb-2">
                            <span class="w-2 h-2 bg-white rounded-full"></span>
                            Plano Mais Popular
                        </div>
                        @endif
                        
                        <h1 class="text-4xl md:text-6xl font-black tracking-tight {{ $currentPlan->name === 'Smart' ? 'text-white' : 'text-zinc-900 dark:text-white' }}">
                            Plano {{ $currentPlan->name }}
                        </h1>
                        <p class="text-lg {{ $currentPlan->name === 'Smart' ? 'text-white/90' : 'text-zinc-600 dark:text-zinc-300' }}">
                            {{ $currentPlan->description }}
                        </p>
                        
                        <div class="flex items-baseline gap-2 mb-6">
                            <span class="text-6xl font-black {{ $currentPlan->name === 'Smart' ? 'text-white' : 'text-zinc-900 dark:text-white' }}">
                                R$ {{ number_format($currentPlan->price, 2, ',', '.') }}
                            </span>
                            <span class="{{ $currentPlan->name === 'Smart' ? 'text-white/70' : 'text-zinc-600 dark:text-zinc-400' }}">/mês</span>
                        </div>
                        
                        <div class="flex gap-4">
                            <a href="{{ route('cadastro') }}" class="px-8 py-4 text-lg font-bold {{ $currentPlan->name === 'Smart' ? 'text-orange-500 bg-white hover:bg-gray-50' : 'text-white bg-primary hover:bg-primary/90' }} rounded-lg transition-colors inline-block text-center">
                                Cadastre-se
                            </a>
                            @if($currentPlan->name === 'Basic')
                            <a href="{{ route('plan.smart') }}" class="px-8 py-4 text-lg font-bold text-zinc-600 dark:text-zinc-300 border border-zinc-200 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-700 rounded-lg transition-colors">
                                Ver Smart →
                            </a>
                            @elseif($currentPlan->name === 'Smart')
                            <a href="{{ route('plan.black') }}" class="px-8 py-4 text-lg font-bold text-white border border-white/30 hover:bg-white/10 rounded-lg transition-colors">
                                Ver Black →
                            </a>
                            @elseif($currentPlan->name === 'Black')
                            <a href="{{ route('plan.smart') }}" class="px-8 py-4 text-lg font-bold text-zinc-600 dark:text-zinc-300 border border-zinc-200 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-700 rounded-lg transition-colors">
                                Comparar com Smart ←
                            </a>
                            @endif
                        </div>
                    </div>
                    
                    <div class="relative">
                        <div class="w-full aspect-video bg-cover bg-center rounded-xl bg-gradient-to-r from-zinc-100 to-zinc-200 dark:from-zinc-700 dark:to-zinc-800 flex items-center justify-center">
                            @if($currentPlan->name === 'Basic')
                            <div class="text-center">
                                <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mb-4 mx-auto">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Poder Básico</h3>
                                <p class="text-zinc-600 dark:text-zinc-400">Todos os equipamentos essenciais</p>
                            </div>
                            @elseif($currentPlan->name === 'Smart')
                            <div class="text-center text-white">
                                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mb-4 mx-auto">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-white">Super Inteligente</h3>
                                <p class="text-white/80">Tecnologia + Comunidade</p>
                            </div>
                            @else
                            <div class="text-center">
                                <div class="w-16 h-16 bg-zinc-900 dark:bg-white rounded-full flex items-center justify-center mb-4 mx-auto">
                                    <svg class="w-8 h-8 text-white dark:text-zinc-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Ultra Premium</h3>
                                <p class="text-zinc-600 dark:text-zinc-400">Experiência completa VIP</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Benefícios Detalhados -->
        <section class="py-16 md:py-24 bg-white dark:bg-zinc-900">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 gap-16">
                    <!-- O que você recebe -->
                    <div>
                        <h2 class="text-3xl font-bold text-zinc-900 dark:text-white mb-8">O que você recebe</h2>
                        <ul class="space-y-4">
                            @foreach($currentPlan->features as $feature)
                            <li class="flex items-start gap-3">
                                <div class="w-6 h-6 bg-primary flex-shrink-0 rounded-full flex items-center justify-center mt-0.5">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-zinc-700 dark:text-zinc-300">{{ $feature }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    
                    <!-- Benefícios exclusivos -->
                    <div>
                        <h2 class="text-3xl font-bold text-zinc-900 dark:text-white mb-8">Benefícios exclusivos</h2>
                        <ul class="space-y-4">
                            @foreach($currentPlan->benefits as $benefit)
                            <li class="flex items-start gap-3">
                                <div class="w-6 h-6 bg-orange-500 flex-shrink-0 rounded-full flex items-center justify-center mt-0.5">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                </div>
                                <span class="text-zinc-700 dark:text-zinc-300">{{ $benefit }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Outros Planos -->
        <section class="py-16 md:py-24 bg-zinc-50 dark:bg-zinc-800">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-zinc-900 dark:text-white">Outros Planos</h2>
                <div class="grid md:grid-cols-2 gap-8">
                    @foreach($plans->where('name', '!=', $currentPlan->name) as $otherPlan)
                    <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-xl p-8 flex flex-col">
                        <h3 class="text-xl font-bold text-zinc-900 dark:text-white mb-2">{{ $otherPlan->name }}</h3>
                        <p class="text-zinc-600 dark:text-zinc-400 mb-4">{{ $otherPlan->description }}</p>
                        <div class="flex items-baseline gap-2 mb-6">
                            <span class="text-3xl font-bold text-primary">R$ {{ number_format($otherPlan->price, 2, ',', '.') }}</span>
                            <span class="text-zinc-600 dark:text-zinc-400">/mês</span>
                        </div>
                        <a href="{{ route('plan.' . strtolower($otherPlan->name)) }}" class="w-full py-3 font-bold text-primary border border-primary hover:bg-primary/10 dark:hover:bg-primary/20 rounded-lg transition-colors text-center">
                            Ver Detalhes
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    <!-- Rodapé Completo -->
    @include('components.footer')
</div>
</body>
</html>
