<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Planos - FitPlan Academy</title>
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

    <!-- Main Content -->
    <main class="py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-zinc-900 dark:text-white mb-2">
                            Gerenciar Planos
                        </h1>
                        <p class="text-zinc-600 dark:text-zinc-400">
                            Gerencie os planos e valores da academia.
                        </p>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-zinc-200 dark:bg-zinc-700 text-zinc-700 dark:text-zinc-300 rounded-lg hover:bg-zinc-300 dark:hover:bg-zinc-600 transition-colors">
                        ← Voltar
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-green-800 dark:text-green-200">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Plans Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($plans as $plan)
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $plan->name }}</h3>
                            @if($plan->is_active)
                                <span class="px-3 py-1 text-xs font-medium bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-full">Ativo</span>
                            @else
                                <span class="px-3 py-1 text-xs font-medium bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 rounded-full">Inativo</span>
                            @endif
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-3xl font-bold text-primary mb-1">
                                R$ {{ number_format($plan->price, 2, ',', '.') }}
                            </p>
                            <p class="text-sm text-zinc-600 dark:text-zinc-400">por mês</p>
                        </div>

                        <p class="text-zinc-600 dark:text-zinc-400 mb-4">{{ $plan->description }}</p>

                        <div class="mb-4">
                            <h4 class="text-sm font-semibold text-zinc-900 dark:text-white mb-2">Funcionalidades:</h4>
                            <ul class="space-y-1">
                                @if(is_array($plan->features))
                                    @foreach($plan->features as $feature)
                                        <li class="text-sm text-zinc-600 dark:text-zinc-400 flex items-center gap-2">
                                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $feature }}
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                        <a href="{{ route('admin.plans.edit', $plan) }}" class="block w-full text-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors font-semibold">
                            ✏️ Editar Plano
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-zinc-600 dark:text-zinc-400">Nenhum plano encontrado.</p>
                </div>
                @endforelse
            </div>
        </div>
    </main>
</div>
</body>
</html>

