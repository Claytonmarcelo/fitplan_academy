<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>FitPlan Academy - Eleve Seu Fitness</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f7f5;
        }
        .primary {
            color: #ff6a00;
        }
        .bg-primary {
            background-color: #ff6a00;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-8 h-8 bg-primary rounded"></div>
                    <h1 class="text-2xl font-bold">FitPlan Academy</h1>
                </div>
                <nav class="hidden md:flex items-center gap-8">
                    <a href="#hero" class="text-gray-600 hover:text-primary">Home</a>
                    <a href="#planos" class="text-gray-600 hover:text-primary">Planos</a>
                    <a href="#comparacao" class="text-gray-600 hover:text-primary">Comparação</a>
                    <a href="#locais" class="text-gray-600 hover:text-primary">Locais</a>
                </nav>
                <div class="flex items-center gap-2">
                    <a href="/login" class="px-4 py-2 text-gray-600 hover:text-primary">Entrar</a>
                    <a href="/cadastro" class="px-4 py-2 bg-primary text-white rounded-lg hover:opacity-90">Cadastre-se</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="hero" class="py-20 bg-gradient-to-br from-orange-50 to-orange-100">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-5xl font-bold mb-6">
                Eleve Seu <span class="primary">Fitness</span>
            </h2>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Transforme seu corpo e sua mente com nossos planos personalizados e instalações de última geração.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#planos" class="px-8 py-4 bg-primary text-white rounded-lg font-bold hover:opacity-90">
                    Ver Planos
                </a>
                <a href="/cadastro" class="px-8 py-4 border-2 border-primary text-primary rounded-lg font-bold hover:bg-primary hover:text-white">
                    Começar Agora
                </a>
            </div>
        </div>
    </section>

    <!-- Planos Section -->
    <section id="planos" class="py-20">
        <div class="container mx-auto px-4">
            <h3 class="text-4xl font-bold text-center mb-12">Nossos Planos</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Plano Basic -->
                <div class="bg-white rounded-xl p-8 border shadow-sm">
                    <h4 class="text-2xl font-bold mb-4">Basic</h4>
                    <p class="text-3xl font-bold primary mb-6">R$ 89,90</p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            Acesso à academia
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            Equipamentos básicos
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            Horário comercial
                        </li>
                    </ul>
                    <button class="w-full py-3 border-2 border-primary text-primary rounded-lg font-bold hover:bg-primary hover:text-white">
                        Escolher Plano
                    </button>
                </div>

                <!-- Plano Smart -->
                <div class="bg-white rounded-xl p-8 border-2 border-primary shadow-lg relative">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <span class="bg-primary text-white px-4 py-1 rounded-full text-sm font-bold">POPULAR</span>
                    </div>
                    <h4 class="text-2xl font-bold mb-4">Smart</h4>
                    <p class="text-3xl font-bold primary mb-6">R$ 149,90</p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            Tudo do Basic
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            Personal trainer
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            Aulas em grupo
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            Horário estendido
                        </li>
                    </ul>
                    <button class="w-full py-3 bg-primary text-white rounded-lg font-bold hover:opacity-90">
                        Escolher Plano
                    </button>
                </div>

                <!-- Plano Black -->
                <div class="bg-white rounded-xl p-8 border shadow-sm">
                    <h4 class="text-2xl font-bold mb-4">Black</h4>
                    <p class="text-3xl font-bold primary mb-6">R$ 299,90</p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            Tudo do Smart
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            Instalações premium
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            Acesso 24h
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            Nutricionista
                        </li>
                    </ul>
                    <button class="w-full py-3 border-2 border-primary text-primary rounded-lg font-bold hover:bg-primary hover:text-white">
                        Escolher Plano
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2025 FitPlan Academy. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
