<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Pagamento Confirmado - FitPlan Academy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet"/>
</head>
<body class="bg-gray-50 font-['Inter']">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full bg-white rounded-lg shadow-xl p-8 text-center">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-gray-900 mb-4">Pagamento Confirmado!</h1>
            <p class="text-gray-600 mb-6">
                Sua assinatura do plano <span class="font-bold text-orange-600">{{ $plan->name }}</span> foi ativada com sucesso!
            </p>

            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <p class="text-sm text-gray-600 mb-2">Valor cobrado:</p>
                <p class="text-2xl font-bold text-gray-900">R$ {{ number_format($plan->price, 2, ',', '.') }}/mês</p>
            </div>

            <div class="space-y-3">
                <a href="{{ route('login') }}"
                   class="block w-full bg-orange-600 text-white py-3 rounded-lg font-bold hover:bg-orange-700 transition-colors">
                    Fazer Login
                </a>
                <a href="{{ route('landing') }}"
                   class="block w-full bg-gray-200 text-gray-700 py-3 rounded-lg font-bold hover:bg-gray-300 transition-colors">
                    Voltar ao Início
                </a>
            </div>

            <p class="text-sm text-gray-500 mt-6">
                Um email de confirmação foi enviado para você com todos os detalhes da sua assinatura.
            </p>
        </div>
    </div>
</body>
</html>

