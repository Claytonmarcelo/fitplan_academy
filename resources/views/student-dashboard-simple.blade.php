<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>FitPlan Academy - Dashboard do Aluno</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #f8f7f5;
            font-family: 'Inter', sans-serif;
        }
        .primary {
            color: #ff6b35;
        }
        .bg-primary {
            background-color: #ff6b35;
        }
    </style>
</head>
<body>
    <!-- Header Simples -->
    <header class="bg-white shadow-sm border-b">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold primary">FitPlan Academy</h1>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-sm font-semibold">
                        S
                    </div>
                    <span class="text-sm font-medium">Sophia Silva</span>
                    <a href="/logout" class="px-4 py-2 text-sm font-bold text-gray-600 hover:text-primary">Sair</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Conteúdo Principal -->
    <main class="container mx-auto px-4 py-8">
        <h2 class="text-4xl font-bold mb-8">
            Olá, Sophia
        </h2>

        <!-- Mensagem de Sucesso -->
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            Bem-vindo, Sophia Silva!
        </div>
        
        <!-- Cards de Estatísticas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Frequência do Mês -->
            <div class="bg-white border rounded-xl p-6">
                <h3 class="text-lg font-semibold mb-2">Frequência do mês</h3>
                <p class="text-3xl font-bold">
                    12
                    <span class="text-base font-medium text-gray-500">/20 dias</span>
                </p>
            </div>

            <!-- Próximo Vencimento -->
            <div class="bg-white border rounded-xl p-6">
                <h3 class="text-lg font-semibold mb-2">Próximo vencimento</h3>
                <p class="text-3xl font-bold">
                    22 de Nov
                </p>
            </div>

            <!-- Progresso de Metas -->
            <div class="bg-white border rounded-xl p-6">
                <h3 class="text-lg font-semibold mb-2">Progresso de metas</h3>
                <p class="text-3xl font-bold">
                    68%
                </p>
            </div>
        </div>

        <!-- Treinos de Hoje -->
        <h3 class="text-2xl font-bold mb-6">Seus Treinos de Hoje</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Série A - Pernas -->
            <div class="bg-white border rounded-xl p-6">
                <h4 class="text-xl font-bold mb-4">Série A - Pernas</h4>
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between">
                        <p>Agachamento Livre</p>
                        <p class="font-medium">3x12</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Leg Press 45º</p>
                        <p class="font-medium">4x10</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Cadeira Extensora</p>
                        <p class="font-medium">4x15</p>
                    </div>
                </div>
                <button class="w-full bg-primary text-white font-bold py-3 px-4 rounded-lg hover:opacity-90">
                    Começar Treino
                </button>
            </div>

            <!-- Série B - Peito e Tríceps -->
            <div class="bg-white border rounded-xl p-6">
                <h4 class="text-xl font-bold mb-4">Série B - Peito e Tríceps</h4>
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between">
                        <p>Supino Reto</p>
                        <p class="font-medium">4x8</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Crucifixo Inclinado</p>
                        <p class="font-medium">3x12</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Tríceps Pulley</p>
                        <p class="font-medium">4x10</p>
                    </div>
                </div>
                <button class="w-full bg-gray-200 text-gray-600 font-bold py-3 px-4 rounded-lg cursor-not-allowed">
                    Concluído
                </button>
            </div>

            <!-- Série C - Costas e Bíceps -->
            <div class="bg-white border rounded-xl p-6">
                <h4 class="text-xl font-bold mb-4">Série C - Costas e Bíceps</h4>
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between">
                        <p>Barra Fixa</p>
                        <p class="font-medium">3xFalha</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Remada Curvada</p>
                        <p class="font-medium">4x10</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Puxada Alta</p>
                        <p class="font-medium">3x12</p>
                    </div>
                </div>
                <button class="w-full bg-primary text-white font-bold py-3 px-4 rounded-lg hover:opacity-90">
                    Começar Treino
                </button>
            </div>
        </div>
    </main>
</body>
</html>
