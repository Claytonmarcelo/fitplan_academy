<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Nossas Unidades - FitPlan Academy</title>
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
    @include('components.header')

    <main>
        <!-- Hero Section -->
        <section class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-black tracking-tighter text-zinc-900 dark:text-white mb-6">Nossas Unidades</h1>
                <p class="text-lg text-zinc-600 dark:text-zinc-300 max-w-2xl mx-auto">Conheça nossas unidades espalhadas por São Paulo, cada uma com suas características únicas e equipamentos especializados.</p>
            </div>
        </section>

        <!-- Units Grid -->
        <section class="container mx-auto px-4 sm:px-6 lg:px-8 pb-16 md:pb-24">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($units as $unit)
                <div class="bg-white dark:bg-background-dark border border-zinc-200 dark:border-zinc-800 rounded-xl overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="w-full h-64 bg-cover bg-center" style='background-image: url("{{ $unit['image'] }}");'></div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-2">{{ $unit['name'] }}</h3>
                        <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">{{ $unit['address'] }}</p>
                        <p class="text-sm text-zinc-600 dark:text-zinc-300 mb-6">{{ $unit['description'] }}</p>
                        
                        <!-- Features Preview -->
                        <div class="mb-6">
                            <h4 class="font-semibold text-zinc-900 dark:text-white mb-3">Principais Recursos:</h4>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach(array_slice($unit['features'], 0, 4) as $feature)
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-primary flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-xs text-zinc-600 dark:text-zinc-300">{{ $feature }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Classes Preview -->
                        <div class="mb-6">
                            <h4 class="font-semibold text-zinc-900 dark:text-white mb-3">Aulas Disponíveis:</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach(array_slice($unit['classes'], 0, 4) as $class)
                                <span class="px-2 py-1 text-xs bg-primary/10 dark:bg-primary/20 text-primary rounded-full">{{ $class }}</span>
                                @endforeach
                                @if(count($unit['classes']) > 4)
                                <span class="px-2 py-1 text-xs bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 rounded-full">+{{ count($unit['classes']) - 4 }} mais</span>
                                @endif
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <div class="mb-6">
                            <div class="flex items-center gap-2 mb-2">
                                <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.01 1.01l-1.5 2.5a1 1 0 01-.8.4H4a1 1 0 01-1-1V4a1 1 0 011-1z"></path>
                                </svg>
                                <span class="text-sm text-zinc-600 dark:text-zinc-400">{{ $unit['contact']['phone'] }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                </svg>
                                <span class="text-sm text-zinc-600 dark:text-zinc-400">{{ $unit['contact']['email'] }}</span>
                            </div>
                        </div>

                        <a href="{{ route('unit.show', $unit['id']) }}" class="w-full inline-flex items-center justify-center px-4 py-2 text-sm font-bold text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">
                            Ver Detalhes
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- CTA Section -->
        <section class="bg-background-light dark:bg-zinc-900 py-16 md:py-24">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 text-zinc-900 dark:text-white">Pronto para começar?</h2>
                <p class="text-lg text-zinc-600 dark:text-zinc-300 mb-8 max-w-2xl mx-auto">Escolha a unidade mais próxima de você e comece sua jornada fitness hoje mesmo.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('cadastro') }}" class="px-6 py-3 text-base font-bold text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">Cadastre-se</a>
                    <a href="{{ route('landing') }}#planos" class="px-6 py-3 text-base font-bold text-zinc-600 dark:text-zinc-300 border border-zinc-300 dark:border-zinc-600 rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-800 transition-colors">Ver Planos</a>
                </div>
            </div>
        </section>
    </main>

    @include('components.footer')
</div>
</body>
</html>
