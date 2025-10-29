<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $unit['name'] }} - FitPlan Academy</title>
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
        <!-- Hero Section -->
        <section class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="flex flex-col gap-6">
                    <h1 class="text-4xl md:text-6xl font-black tracking-tighter text-zinc-900 dark:text-white">{{ $unit['name'] }}</h1>
                    <p class="text-lg text-zinc-600 dark:text-zinc-300">{{ $unit['description'] }}</p>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-sm text-zinc-600 dark:text-zinc-400">{{ $unit['address'] }}</span>
                        </div>
                    </div>
                    <a href="{{ route('cadastro') }}" class="self-start px-6 py-3 text-base font-bold text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">Cadastre-se</a>
                </div>
                <div class="w-full aspect-video bg-cover bg-center rounded-xl" style='background-image: url("{{ $unit['image'] }}");'></div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="bg-background-light dark:bg-zinc-900 py-16 md:py-24">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-zinc-900 dark:text-white">O que oferecemos</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($unit['features'] as $feature)
                    <div class="bg-white dark:bg-background-dark border border-zinc-200 dark:border-zinc-800 rounded-xl p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-8 h-8 bg-primary/10 dark:bg-primary/20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-zinc-900 dark:text-white">{{ $feature }}</h3>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Equipment Section -->
        <section class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-zinc-900 dark:text-white">Equipamentos</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($unit['equipment'] as $equipment)
                <div class="bg-white dark:bg-background-dark border border-zinc-200 dark:border-zinc-800 rounded-lg p-4 text-center">
                    <div class="w-12 h-12 bg-primary/10 dark:bg-primary/20 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <p class="text-sm text-zinc-600 dark:text-zinc-300">{{ $equipment }}</p>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Classes Section -->
        <section class="bg-background-light dark:bg-zinc-900 py-16 md:py-24">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-zinc-900 dark:text-white">Aulas Disponíveis</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($unit['classes'] as $class)
                    <div class="bg-white dark:bg-background-dark border border-zinc-200 dark:border-zinc-800 rounded-lg p-6 text-center">
                        <div class="w-16 h-16 bg-primary/10 dark:bg-primary/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-zinc-900 dark:text-white mb-2">{{ $class }}</h3>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Hours and Contact Section -->
        <section class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="grid md:grid-cols-2 gap-12">
                <!-- Hours -->
                <div class="bg-white dark:bg-background-dark border border-zinc-200 dark:border-zinc-800 rounded-xl p-8">
                    <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-6">Horários de Funcionamento</h3>
                    <div class="space-y-3">
                        @foreach($unit['operating_hours'] as $hour)
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-zinc-600 dark:text-zinc-300">{{ $hour }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Contact -->
                <div class="bg-white dark:bg-background-dark border border-zinc-200 dark:border-zinc-800 rounded-xl p-8">
                    <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-6">Contato</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.01 1.01l-1.5 2.5a1 1 0 01-.8.4H4a1 1 0 01-1-1V4a1 1 0 011-1z"></path>
                                <path d="M6 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.01 1.01l-1.5 2.5a1 1 0 01-.8.4H8a1 1 0 01-1-1V4a1 1 0 011-1z"></path>
                            </svg>
                            <span class="text-zinc-600 dark:text-zinc-300">{{ $unit['contact']['phone'] }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            <span class="text-zinc-600 dark:text-zinc-300">{{ $unit['contact']['email'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Other Units Section -->
        @if(count($otherUnits) > 0)
        <section class="bg-background-light dark:bg-zinc-900 py-16 md:py-24">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-zinc-900 dark:text-white">Outras Unidades</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($otherUnits as $otherUnit)
                    <div class="bg-white dark:bg-background-dark border border-zinc-200 dark:border-zinc-800 rounded-xl overflow-hidden">
                        <div class="w-full h-48 bg-cover bg-center" style='background-image: url("{{ $otherUnit['image'] }}");'></div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-zinc-900 dark:text-white mb-2">{{ $otherUnit['name'] }}</h3>
                            <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">{{ $otherUnit['address'] }}</p>
                            <a href="{{ route('unit.show', $otherUnit['id']) }}" class="inline-flex items-center text-primary hover:text-primary/80 transition-colors">
                                Ver {{ $otherUnit['name'] }} →
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif
    </main>

    @include('components.footer')
</div>
</body>
</html>
