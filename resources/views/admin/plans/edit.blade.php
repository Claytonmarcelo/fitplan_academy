<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Plano - FitPlan Academy</title>
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
            <div class="max-w-2xl mx-auto">
                <!-- Header Section -->
                <div class="mb-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white mb-2">
                                Editar Plano: {{ $plan->name }}
                            </h1>
                            <p class="text-zinc-600 dark:text-zinc-400">
                                Atualize as informações e valores do plano.
                            </p>
                        </div>
                        <a href="{{ route('admin.plans.index') }}" class="px-4 py-2 bg-zinc-200 dark:bg-zinc-700 text-zinc-700 dark:text-zinc-300 rounded-lg hover:bg-zinc-300 dark:hover:bg-zinc-600 transition-colors">
                            ← Voltar
                        </a>
                    </div>
                </div>

                @if($errors->any())
                    <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <div>
                                <h3 class="text-sm font-medium text-red-800 dark:text-red-200">Corrija os seguintes erros:</h3>
                                <ul class="mt-2 text-sm text-red-700 dark:text-red-300">
                                    @foreach ($errors->all() as $error)
                                        <li>• {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Form -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-6">
                    <form method="POST" action="{{ route('admin.plans.update', $plan) }}">
                        @csrf
                        @method('PUT')

                        <!-- Nome do Plano -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Nome do Plano *</label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $plan->name) }}"
                                   required
                                   class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>

                        <!-- Descrição -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Descrição *</label>
                            <textarea id="description" 
                                      name="description" 
                                      rows="3"
                                      required
                                      class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary">{{ old('description', $plan->description) }}</textarea>
                        </div>

                        <!-- Preço -->
                        <div class="mb-6">
                            <label for="price" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Preço Mensal (R$) *</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-zinc-500 dark:text-zinc-400">R$</span>
                                <input type="number" 
                                       id="price" 
                                       name="price" 
                                       value="{{ old('price', $plan->price) }}"
                                       step="0.01"
                                       min="0"
                                       required
                                       class="w-full pl-10 pr-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Digite o valor mensal do plano (ex: 79.90)</p>
                        </div>

                        <!-- Status -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Status do Plano *</label>
                            <div class="flex items-center gap-4">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" 
                                           name="is_active" 
                                           value="1"
                                           {{ old('is_active', $plan->is_active) ? 'checked' : '' }}
                                           required
                                           class="w-4 h-4 text-primary focus:ring-primary">
                                    <span class="text-zinc-700 dark:text-zinc-300">Ativo</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" 
                                           name="is_active" 
                                           value="0"
                                           {{ !old('is_active', $plan->is_active) ? 'checked' : '' }}
                                           required
                                           class="w-4 h-4 text-primary focus:ring-primary">
                                    <span class="text-zinc-700 dark:text-zinc-300">Inativo</span>
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center gap-3">
                            <button type="submit" class="flex-1 px-4 py-3 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors font-semibold">
                                💾 Salvar Alterações
                            </button>
                            <a href="{{ route('admin.plans.index') }}" class="px-4 py-3 bg-zinc-200 dark:bg-zinc-700 text-zinc-700 dark:text-zinc-300 rounded-lg hover:bg-zinc-300 dark:hover:bg-zinc-600 transition-colors">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>

