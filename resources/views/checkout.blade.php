<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Checkout - FitPlan Academy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet"/>
</head>
<body class="bg-gray-50 font-['Inter']">
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Finalizar Compra</h1>
                <p class="mt-2 text-gray-600">Complete seu pagamento para ativar sua assinatura</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Resumo do Pedido -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold mb-4">Resumo do Pedido</h2>
                    
                    <div class="border-b pb-4 mb-4">
                        <h3 class="font-bold text-lg">Plano {{ $plan->name }}</h3>
                        <p class="text-gray-600 text-sm mt-1">{{ $plan->description }}</p>
                    </div>

                    <div class="space-y-2 mb-4">
                        <h4 class="font-semibold">Inclui:</h4>
                        <ul class="space-y-2">
                            @foreach(json_decode($plan->features) as $feature)
                            <li class="flex items-start gap-2 text-sm text-gray-600">
                                <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                {{ $feature }}
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="border-t pt-4">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-600">Subtotal:</span>
                            <span class="font-medium">R$ {{ number_format($plan->price, 2, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold">
                            <span>Total:</span>
                            <span class="text-orange-600">R$ {{ number_format($plan->price, 2, ',', '.') }}/mês</span>
                        </div>
                    </div>
                </div>

                <!-- Formulário de Pagamento -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold mb-4">Dados de Pagamento</h2>
                    
                    <form action="{{ route('checkout.process', $plan->id) }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nome Completo</label>
                            <input type="text" name="name" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                   placeholder="Seu nome completo">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                   placeholder="seu@email.com">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Número do Cartão</label>
                            <input type="text" name="card_number" required maxlength="19"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                   placeholder="1234 5678 9012 3456">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Validade</label>
                                <input type="text" name="card_expiry" required placeholder="MM/AA"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                                <input type="text" name="card_cvv" required maxlength="3"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                       placeholder="123">
                            </div>
                        </div>

                        <button type="submit"
                                class="w-full bg-orange-600 text-white py-3 rounded-lg font-bold hover:bg-orange-700 transition-colors">
                            Finalizar Pagamento
                        </button>

                        <p class="text-xs text-gray-500 text-center">
                            🔒 Pagamento seguro e criptografado
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

