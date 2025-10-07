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
    <header class="sticky top-0 z-50 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-sm border-b border-zinc-200 dark:border-zinc-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-4">
                    <div class="text-primary size-8">
                        <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path d="M42.1739 20.1739L27.8261 5.82609C29.1366 7.13663 28.3989 10.1876 26.2002 13.7654C24.8538 15.9564 22.9595 18.3449 20.6522 20.6522C18.3449 22.9595 15.9564 24.8538 13.7654 26.2002C10.1876 28.3989 7.13663 29.1366 5.82609 27.8261L20.1739 42.1739C21.4845 43.4845 24.5355 42.7467 28.1133 40.548C30.3042 39.2016 32.6927 37.3073 35 35C37.3073 32.6927 39.2016 30.3042 40.548 28.1133C42.7467 24.5355 43.4845 21.4845 42.1739 20.1739Z" fill="currentColor"></path>
                            <path clip-rule="evenodd" d="M7.24189 26.4066C7.31369 26.4411 7.64204 26.5637 8.52504 26.3738C9.59462 26.1438 11.0343 25.5311 12.7183 24.4963C14.7583 23.2426 17.0256 21.4503 19.238 19.238C21.4503 17.0256 23.2426 14.7583 24.4963 12.7183C25.5311 11.0343 26.1438 9.59463 26.3738 8.52504C26.5637 7.64204 26.4411 7.31369 26.4066 7.24189C26.345 7.21246 26.143 7.14535 25.6664 7.1918C24.9745 7.25925 23.9954 7.5498 22.7699 8.14278C20.3369 9.32007 17.3369 11.4915 14.4142 14.4142C11.4915 17.3369 9.32007 20.3369 8.14278 22.7699C7.5498 23.9954 7.25925 24.9745 7.1918 25.6664C7.14534 26.143 7.21246 26.345 7.24189 26.4066ZM29.9001 10.7285C29.4519 12.0322 28.7617 13.4172 27.9042 14.8126C26.465 17.1544 24.4686 19.6641 22.0664 22.0664C19.6641 24.4686 17.1544 26.465 14.8126 27.9042C13.4172 28.7617 12.0322 29.4519 10.7285 29.9001L21.5754 40.747C21.6001 40.7606 21.8995 40.931 22.8729 40.7217C23.9424 40.4916 25.3821 39.879 27.0661 38.8441C29.1062 37.5904 31.3734 35.7982 33.5858 33.5858C35.7982 31.3734 37.5904 29.1062 38.8441 27.0661C39.879 25.3821 40.4916 23.9425 40.7216 22.8729C40.931 21.8995 40.7606 21.6001 40.747 21.5754L29.9001 10.7285ZM29.2403 4.41187L43.5881 18.7597C44.9757 20.1473 44.9743 22.1235 44.6322 23.7139C44.2714 25.3919 43.4158 27.2666 42.252 29.1604C40.8128 31.5022 38.8165 34.012 36.4142 36.4142C34.012 38.8165 31.5022 40.8128 29.1604 42.252C27.2666 43.4158 25.3919 44.2714 23.7139 44.6322C22.1235 44.9743 20.1473 44.9757 18.7597 43.5881L4.41187 29.2403C3.29027 28.1187 3.08209 26.5973 3.21067 25.2783C3.34099 23.9415 3.8369 22.4852 4.54214 21.0277C5.96129 18.0948 8.43335 14.7382 11.5858 11.5858C14.7382 8.43335 18.0948 5.9613 21.0277 4.54214C22.4852 3.8369 23.9415 3.34099 25.2783 3.21067C26.5973 3.08209 28.1187 3.29028 29.2403 4.41187Z" fill="currentColor" fill-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">FitPlan Academy</h1>
                </div>
                <nav class="hidden md:flex items-center gap-8">
                    <a class="text-sm font-medium text-zinc-600 dark:text-zinc-300 hover:text-primary dark:hover:text-primary transition-colors" href="{{ route('landing') }}">Home</a>
                    <a class="text-sm font-medium text-zinc-600 dark:text-zinc-300 hover:text-primary dark:hover:text-primary transition-colors" href="{{ route('landing') }}#planos">Planos</a>
                    <a class="text-sm font-medium text-zinc-600 dark:text-zinc-300 hover:text-primary dark:hover:text-primary transition-colors" href="{{ route('landing') }}#comparacao">Comparação</a>
                    <a class="text-sm font-medium text-zinc-600 dark:text-zinc-300 hover:text-primary dark:hover:text-primary transition-colors" href="{{ route('landing') }}#locais">Locais</a>
                </nav>
                <div class="flex items-center gap-2">
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-bold text-zinc-600 dark:text-zinc-300 hover:text-primary transition-colors">Entrar</a>
                    <a href="{{ route('cadastro') }}" class="px-4 py-2 text-sm font-bold text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">Cadastre-se</a>
                </div>
            </div>
        </div>
    </header>

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

    <footer class="bg-background-light dark:bg-zinc-900 border-t border-zinc-200 dark:border-zinc-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 text-center text-zinc-600 dark:text-zinc-400">
            <div class="flex justify-center gap-6 mb-8">
                <a class="hover:text-primary transition-colors" href="#">Política de Privacidade</a>
                <a class="hover:text-primary transition-colors" href="#">Termos de Serviço</a>
                <a class="hover:text-primary transition-colors" href="#">Contato</a>
            </div>
            <p class="text-sm">© 2024 FitPlan Academy. Todos os direitos reservados.</p>
        </div>
    </footer>
</div>
</body>
</html>
