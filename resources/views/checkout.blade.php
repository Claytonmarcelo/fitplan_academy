<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>FitPlan Academy - Checkout</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ff6a00",
                        "background-light": "#f8f7f5",
                        "background-dark": "#1a1a1a",
                        "text-light": "#f8f7f5",
                        "text-dark": "#23170f",
                        "card-light": "#ffffff",
                        "card-dark": "#2c2c2c",
                        "border-light": "#e5e7eb",
                        "border-dark": "#3c3c3c",
                    },
                    fontFamily: {
                        "display": ["Inter"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "0.75rem",
                        "xl": "1rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .form-input-float {
            position: relative;
        }
        .form-input-float input {
            padding-top: 1.5rem;
        }
        .form-input-float label {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
            transition: all 0.2s ease-out;
            pointer-events: none;
            color: #6b7280;
        }
        .form-input-float input:focus+label,
        .form-input-float input:not(:placeholder-shown)+label {
            top: 0.75rem;
            font-size: 0.75rem;
            color: #ff6a00;
        }
        
        .payment-card {
            transition: all 0.15s ease-in-out;
            position: relative;
        }
        
        .payment-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }
        
        .payment-card.selected {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(255, 106, 0, 0.15);
        }
        
        /* Estilo similar ao Stripe */
        .payment-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 0.5rem;
            border: 1px solid transparent;
            transition: border-color 0.15s ease-in-out;
        }
        
        .payment-card:hover::before {
            border-color: #ff6a00;
        }
        
        /* Loading Modal Animations */
        #loading-modal {
            transition: opacity 0.3s ease-in-out;
        }
        
        #loading-modal .bg-white,
        #loading-modal .dark\\:bg-gray-800 {
            animation: slideInUp 0.4s ease-out;
        }
        
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Spinner animation */
        .animate-spin {
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
        
        /* Pulse animation for dots */
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-text-dark dark:text-text-light">
        <!-- Barra de Acessibilidade -->
        @include('components.accessibility-bar')
        <!-- Modal de Loading -->
        <div id="loading-modal" class="fixed inset-0 z-50 hidden">
            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>
            <div class="relative flex items-center justify-center min-h-screen p-4">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-8 max-w-sm w-full mx-4">
                    <!-- Loading Animation -->
                    <div class="flex flex-col items-center space-y-6">
                        <!-- Spinner -->
                        <div class="relative">
                            <div class="w-16 h-16 border-4 border-orange-200 dark:border-orange-800 rounded-full animate-spin border-t-orange-500"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="material-symbols-outlined text-orange-500 text-2xl animate-pulse">
                                    payment
                                </span>
                            </div>
                        </div>
                        
                        <!-- Loading Text -->
                        <div class="text-center">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                Processando Pagamento
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">
                                Aguarde enquanto processamos sua transação...
                            </p>
                        </div>
                        
                        <!-- Progress Steps -->
                        <div class="w-full space-y-3">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Validando dados</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-gray-300 dark:bg-gray-600 rounded-full"></div>
                                <span class="text-sm text-gray-500 dark:text-gray-500">Processando pagamento</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-gray-300 dark:bg-gray-600 rounded-full"></div>
                                <span class="text-sm text-gray-500 dark:text-gray-500">Finalizando compra</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="min-h-screen flex flex-col lg:flex-row">
            <!-- Resumo do Pedido -->
            <div class="w-full lg:w-1/2 bg-card-light dark:bg-card-dark lg:order-2">
            <div class="px-4 sm:px-6 lg:px-12 py-10 lg:py-24 h-full flex flex-col">
                <h2 class="text-xl font-bold text-text-dark dark:text-text-light mb-6">Resumo do Pedido</h2>
                <div class="flex-grow space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 rounded-lg bg-primary/20 dark:bg-primary/30 p-3">
                                <span class="material-symbols-outlined text-primary">workspace_premium</span>
                            </div>
                            <div>
                                <p class="font-semibold text-text-dark dark:text-text-light">{{ $plan->name }} Plan</p>
                                <p class="text-sm text-text-dark/70 dark:text-text-light/70">Cobrança mensal</p>
                            </div>
                        </div>
                        <p class="text-lg font-semibold text-text-dark dark:text-text-light">R$ {{ number_format($plan->price, 2, ',', '.') }}</p>
                    </div>
                    <div class="border-t border-border-light dark:border-border-dark my-4"></div>
                    <div class="flex justify-between text-sm">
                        <span class="text-text-dark/70 dark:text-text-light/70">Subtotal</span>
                        <span class="text-text-dark dark:text-text-light">R$ {{ number_format($subtotal, 2, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-text-dark/70 dark:text-text-light/70">Impostos</span>
                        <span class="text-text-dark dark:text-text-light">R$ {{ number_format($taxes, 2, ',', '.') }}</span>
                    </div>
                    <div class="border-t border-border-light dark:border-border-dark my-4"></div>
                    <div class="flex justify-between text-lg font-bold text-text-dark dark:text-text-light">
                        <span>Total a pagar hoje</span>
                        <span>R$ {{ number_format($total, 2, ',', '.') }}</span>
                    </div>
                </div>
                <div class="mt-8 text-sm text-text-dark/60 dark:text-text-light/60">
                    <p class="flex items-center"><span class="material-symbols-outlined text-green-500 mr-2">verified_user</span> Pagamento seguro SSL criptografado</p>
                    <p class="mt-4">Ao clicar em "Pagar agora", você concorda com os <a class="text-primary hover:underline" href="#">Termos de Serviço</a> e <a class="text-primary hover:underline" href="#">Política de Privacidade</a> da FitPlan Academy.</p>
                </div>
            </div>
        </div>

        <!-- Formulário de Checkout -->
        <div class="w-full lg:w-1/2 lg:order-1">
            <div class="px-4 sm:px-6 lg:px-12 py-10 lg:py-24">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold tracking-tight text-text-dark dark:text-text-light">FitPlan Academy</h1>
                    <div class="flex items-center space-x-2 text-sm text-text-dark/60 dark:text-text-light/60 mt-2">
                        <span class="font-semibold text-primary">Conta</span>
                        <span class="material-symbols-outlined text-xs">chevron_right</span>
                        <span class="font-semibold text-primary">Pagamento</span>
                        <span class="material-symbols-outlined text-xs">chevron_right</span>
                        <span>Confirmação</span>
                    </div>
                </div>

                <form id="checkout-form" action="{{ route('checkout.process', $plan->id) }}" class="space-y-8" method="POST">
                    @csrf
                    
                    <!-- Informações Pessoais -->
                    <section>
                        <h2 class="text-xl font-semibold mb-4">Informações Pessoais</h2>
                        <div class="grid grid-cols-1 gap-y-6">
                            <div class="grid grid-cols-2 gap-x-4">
                                <div class="form-input-float">
                                    <input class="block w-full rounded-lg border-0 bg-background-light dark:bg-background-dark py-4 px-4 text-text-dark dark:text-text-light shadow-sm ring-1 ring-inset ring-border-light dark:ring-border-dark focus:ring-2 focus:ring-inset focus:ring-primary placeholder:text-transparent" 
                                           id="first_name" name="first_name" placeholder=" " required="" type="text" value="{{ old('first_name') }}"/>
                                    <label for="first_name">Nome</label>
                                    @error('first_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-input-float">
                                    <input class="block w-full rounded-lg border-0 bg-background-light dark:bg-background-dark py-4 px-4 text-text-dark dark:text-text-light shadow-sm ring-1 ring-inset ring-border-light dark:ring-border-dark focus:ring-2 focus:ring-inset focus:ring-primary placeholder:text-transparent" 
                                           id="last_name" name="last_name" placeholder=" " required="" type="text" value="{{ old('last_name') }}"/>
                                    <label for="last_name">Sobrenome</label>
                                    @error('last_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-input-float">
                                <input class="block w-full rounded-lg border-0 bg-background-light dark:bg-background-dark py-4 px-4 text-text-dark dark:text-text-light shadow-sm ring-1 ring-inset ring-border-light dark:ring-border-dark focus:ring-2 focus:ring-inset focus:ring-primary placeholder:text-transparent" 
                                       id="email" name="email" placeholder=" " required="" type="email" value="{{ old('email') }}"/>
                                <label for="email">Endereço de email</label>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-input-float">
                                <input class="block w-full rounded-lg border-0 bg-background-light dark:bg-background-dark py-4 px-4 text-text-dark dark:text-text-light shadow-sm ring-1 ring-inset ring-border-light dark:ring-border-dark focus:ring-2 focus:ring-inset focus:ring-primary placeholder:text-transparent" 
                                       id="phone" name="phone" placeholder=" " required="" type="tel" value="{{ old('phone') }}"/>
                                <label for="phone">Telefone</label>
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-input-float">
                                <input class="block w-full rounded-lg border-0 bg-background-light dark:bg-background-dark py-4 px-4 text-text-dark dark:text-text-light shadow-sm ring-1 ring-inset ring-border-light dark:ring-border-dark focus:ring-2 focus:ring-inset focus:ring-primary placeholder:text-transparent" 
                                       id="cpf" name="cpf" placeholder=" " required="" type="text" value="{{ old('cpf') }}"/>
                                <label for="cpf">CPF</label>
                                @error('cpf')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </section>

                    <!-- Método de Pagamento -->
                    <section>
                        <h2 class="text-xl font-semibold mb-4">Método de Pagamento</h2>
                        
                        <!-- Seleção do Método -->
                        <div class="mb-6">
                            <div class="flex items-center mb-4">
                                <div class="flex-1 border-t border-border-light dark:border-border-dark"></div>
                                <span class="px-4 text-sm text-text-dark/60 dark:text-text-light/60">Ou pague usando</span>
                                <div class="flex-1 border-t border-border-light dark:border-border-dark"></div>
                            </div>
                            
                            <div class="grid grid-cols-3 gap-3">
                                <!-- Cartão de Crédito -->
                                <div class="relative">
                                    <input type="radio" id="payment_credit_card" name="payment_method" value="credit_card" 
                                           class="sr-only" {{ old('payment_method', 'credit_card') == 'credit_card' ? 'checked' : '' }}>
                                    <label for="payment_credit_card" class="block cursor-pointer">
                                        <div class="payment-card bg-primary/10 border-primary ring-2 ring-primary/20 rounded-lg p-3 text-center transition-all duration-150 hover:border-primary hover:shadow-sm" 
                                             id="card-credit_card">
                                            <div class="mb-2">
                                                <svg class="w-6 h-6 mx-auto text-gray-600 dark:text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2zm0 2v2h16V6H4zm0 4v6h16v-6H4zm2 2h2v2H6v-2zm4 0h2v2h-2v-2z"/>
                                                </svg>
                                            </div>
                                            <span class="text-gray-700 dark:text-gray-300 font-medium text-xs">Cartão</span>
                                        </div>
                                    </label>
                                </div>
                                
                                <!-- PIX -->
                                <div class="relative">
                                    <input type="radio" id="payment_pix" name="payment_method" value="pix" 
                                           class="sr-only" {{ old('payment_method') == 'pix' ? 'checked' : '' }}>
                                    <label for="payment_pix" class="block cursor-pointer">
                                        <div class="payment-card bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg p-3 text-center transition-all duration-150 hover:border-primary hover:shadow-sm" 
                                             id="card-pix">
                                            <div class="mb-2">
                                                <svg class="w-6 h-6 mx-auto text-gray-600 dark:text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                                </svg>
                                            </div>
                                            <span class="text-gray-700 dark:text-gray-300 font-medium text-xs">PIX</span>
                                        </div>
                                    </label>
                                </div>
                                
                                <!-- Boleto -->
                                <div class="relative">
                                    <input type="radio" id="payment_boleto" name="payment_method" value="boleto" 
                                           class="sr-only" {{ old('payment_method') == 'boleto' ? 'checked' : '' }}>
                                    <label for="payment_boleto" class="block cursor-pointer">
                                        <div class="payment-card bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg p-3 text-center transition-all duration-150 hover:border-primary hover:shadow-sm" 
                                             id="card-boleto">
                                            <div class="mb-2">
                                                <svg class="w-6 h-6 mx-auto text-gray-600 dark:text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                                </svg>
                                            </div>
                                            <span class="text-gray-700 dark:text-gray-300 font-medium text-xs">Boleto</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        @error('payment_method')
                            <p class="mt-1 text-sm text-red-600 mb-4">{{ $message }}</p>
                        @enderror

                        <!-- Campos do Cartão de Crédito -->
                        <div id="credit-card-fields" class="space-y-6">
                            <div class="form-input-float">
                                <input class="block w-full rounded-lg border-0 bg-background-light dark:bg-background-dark py-4 px-4 text-text-dark dark:text-text-light shadow-sm ring-1 ring-inset ring-border-light dark:ring-border-dark focus:ring-2 focus:ring-inset focus:ring-primary placeholder:text-transparent" 
                                       id="card_name" name="card_name" placeholder=" " type="text" value="{{ old('card_name') }}"/>
                                <label for="card_name">Nome no cartão</label>
                                @error('card_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-input-float relative">
                                <input class="block w-full rounded-lg border-0 bg-background-light dark:bg-background-dark py-4 px-4 text-text-dark dark:text-text-light shadow-sm ring-1 ring-inset ring-border-light dark:ring-border-dark focus:ring-2 focus:ring-inset focus:ring-primary placeholder:text-transparent" 
                                       id="card_number" name="card_number" placeholder=" " type="text" value="{{ old('card_number') }}"/>
                                <label for="card_number">Número do cartão</label>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-text-dark/50 dark:text-text-light/50">credit_card</span>
                                </div>
                                @error('card_number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-2 gap-x-4">
                                <div class="form-input-float">
                                    <input class="block w-full rounded-lg border-0 bg-background-light dark:bg-background-dark py-4 px-4 text-text-dark dark:text-text-light shadow-sm ring-1 ring-inset ring-border-light dark:ring-border-dark focus:ring-2 focus:ring-inset focus:ring-primary placeholder:text-transparent" 
                                           id="expiry_date" name="expiry_date" placeholder=" " type="text" value="{{ old('expiry_date') }}"/>
                                    <label for="expiry_date">MM / AA</label>
                                    @error('expiry_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-input-float relative">
                                    <input class="block w-full rounded-lg border-0 bg-background-light dark:bg-background-dark py-4 px-4 text-text-dark dark:text-text-light shadow-sm ring-1 ring-inset ring-border-light dark:ring-border-dark focus:ring-2 focus:ring-inset focus:ring-primary placeholder:text-transparent" 
                                           id="cvc" name="cvc" placeholder=" " type="text" value="{{ old('cvc') }}"/>
                                    <label for="cvc">CVC</label>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="material-symbols-outlined text-text-dark/50 dark:text-text-light/50 text-base">help_outline</span>
                                    </div>
                                    @error('cvc')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Informações do PIX -->
                        <div id="pix-info" class="hidden bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                            <div class="flex items-center space-x-3 mb-3">
                                <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">qr_code</span>
                                <span class="text-blue-800 dark:text-blue-200 font-semibold">Pagamento via PIX</span>
                            </div>
                            <p class="text-blue-700 dark:text-blue-300 text-sm">
                                Após confirmar o pedido, você receberá o QR Code do PIX para pagamento instantâneo.
                            </p>
                        </div>

                        <!-- Informações do Boleto -->
                        <div id="boleto-info" class="hidden bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                            <div class="flex items-center space-x-3 mb-3">
                                <span class="material-symbols-outlined text-green-600 dark:text-green-400">receipt</span>
                                <span class="text-green-800 dark:text-green-200 font-semibold">Pagamento via Boleto</span>
                            </div>
                            <p class="text-green-700 dark:text-green-300 text-sm">
                                Após confirmar o pedido, você receberá o boleto bancário para pagamento.
                            </p>
                        </div>
                    </section>

                    <!-- Endereço de Cobrança -->
                    <section>
                        <h2 class="text-xl font-semibold mb-4">Endereço de Cobrança</h2>
                        <div class="grid grid-cols-1 gap-y-6">
                            <div class="form-input-float">
                                <input class="block w-full rounded-lg border-0 bg-background-light dark:bg-background-dark py-4 px-4 text-text-dark dark:text-text-light shadow-sm ring-1 ring-inset ring-border-light dark:ring-border-dark focus:ring-2 focus:ring-inset focus:ring-primary placeholder:text-transparent" 
                                       id="zip_code" name="zip_code" placeholder=" " required="" type="text" value="{{ old('zip_code') }}"/>
                                <label for="zip_code">CEP</label>
                                @error('zip_code')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Campos que aparecem após digitar o CEP -->
                            <div id="address-fields" class="hidden space-y-6">
                                <!-- Campos preenchidos automaticamente pela API -->
                                <div class="grid grid-cols-2 gap-x-4">
                                    <div class="form-input-float">
                                        <input class="block w-full rounded-lg border-0 bg-background-light dark:bg-background-dark py-4 px-4 text-text-dark dark:text-text-light shadow-sm ring-1 ring-inset ring-border-light dark:ring-border-dark focus:ring-2 focus:ring-inset focus:ring-primary placeholder:text-transparent" 
                                               id="street" name="street" placeholder=" " type="text" value="{{ old('street') }}" readonly/>
                                        <label for="street">Rua</label>
                                    </div>
                                    <div class="form-input-float">
                                        <input class="block w-full rounded-lg border-0 bg-background-light dark:bg-background-dark py-4 px-4 text-text-dark dark:text-text-light shadow-sm ring-1 ring-inset ring-border-light dark:ring-border-dark focus:ring-2 focus:ring-inset focus:ring-primary placeholder:text-transparent" 
                                               id="neighborhood" name="neighborhood" placeholder=" " type="text" value="{{ old('neighborhood') }}" readonly/>
                                        <label for="neighborhood">Bairro</label>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-x-4">
                                    <div class="form-input-float">
                                        <input class="block w-full rounded-lg border-0 bg-background-light dark:bg-background-dark py-4 px-4 text-text-dark dark:text-text-light shadow-sm ring-1 ring-inset ring-border-light dark:ring-border-dark focus:ring-2 focus:ring-inset focus:ring-primary placeholder:text-transparent" 
                                               id="city" name="city" placeholder=" " type="text" value="{{ old('city') }}" readonly/>
                                        <label for="city">Cidade</label>
                                    </div>
                                    <div class="form-input-float">
                                        <input class="block w-full rounded-lg border-0 bg-background-light dark:bg-background-dark py-4 px-4 text-text-dark dark:text-text-light shadow-sm ring-1 ring-inset ring-border-light dark:ring-border-dark focus:ring-2 focus:ring-inset focus:ring-primary placeholder:text-transparent" 
                                               id="state" name="state" placeholder=" " type="text" value="{{ old('state') }}" readonly/>
                                        <label for="state">Estado</label>
                                    </div>
                                </div>
                                
                                <div class="form-input-float">
                                    <input class="block w-full rounded-lg border-0 bg-background-light dark:bg-background-dark py-4 px-4 text-text-dark dark:text-text-light shadow-sm ring-1 ring-inset ring-border-light dark:ring-border-dark focus:ring-2 focus:ring-inset focus:ring-primary placeholder:text-transparent" 
                                           id="number" name="number" placeholder=" " required="" type="text" value="{{ old('number') }}"/>
                                    <label for="number">Número</label>
                                    @error('number')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="form-input-float">
                                    <input class="block w-full rounded-lg border-0 bg-background-light dark:bg-background-dark py-4 px-4 text-text-dark dark:text-text-light shadow-sm ring-1 ring-inset ring-border-light dark:ring-border-dark focus:ring-2 focus:ring-inset focus:ring-primary placeholder:text-transparent" 
                                           id="complement" name="complement" placeholder=" " type="text" value="{{ old('complement') }}"/>
                                    <label for="complement">Complemento (opcional)</label>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div>
                        <button id="submit-btn" class="w-full rounded-lg bg-primary py-4 px-4 text-center text-base font-semibold text-white shadow-lg hover:bg-primary/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-transform hover:scale-105" type="submit">
                            <span class="flex items-center justify-center">
                                <span class="material-symbols-outlined mr-2">lock</span>
                                Pagar agora
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <script>
            // Formatação de CPF
            function formatCPF(cpf) {
                cpf = cpf.replace(/\D/g, '');
                return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
            }

            // Formatação de telefone
            function formatPhone(phone) {
                phone = phone.replace(/\D/g, '');
                if (phone.length === 11) {
                    return phone.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
                } else if (phone.length === 10) {
                    return phone.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
                }
                return phone;
            }

            // Formatação de CEP
            function formatCEP(cep) {
                cep = cep.replace(/\D/g, '');
                return cep.replace(/(\d{5})(\d{3})/, '$1-$2');
            }

            // Buscar endereço por CEP usando API do Brasil
            async function fetchAddressByCEP(cep) {
                const cleanCEP = cep.replace(/\D/g, '');
                console.log('Buscando CEP:', cleanCEP);
                
                if (cleanCEP.length !== 8) {
                    console.log('CEP inválido, tamanho:', cleanCEP.length);
                    return;
                }

                try {
                    console.log('Fazendo requisição para ViaCEP...');
                    const response = await fetch(`https://viacep.com.br/ws/${cleanCEP}/json/`);
                    const data = await response.json();
                    
                    console.log('Resposta da API:', data);
                    
                    if (!data.erro) {
                        document.getElementById('street').value = data.logradouro || '';
                        document.getElementById('neighborhood').value = data.bairro || '';
                        document.getElementById('city').value = data.localidade || '';
                        document.getElementById('state').value = data.uf || '';
                        
                        // Mostrar os campos de endereço
                        document.getElementById('address-fields').classList.remove('hidden');
                        console.log('Endereço preenchido e campos mostrados');
                    } else {
                        console.log('CEP não encontrado');
                        // Mostrar campos mesmo se CEP não for encontrado
                        document.getElementById('address-fields').classList.remove('hidden');
                    }
                } catch (error) {
                    console.error('Erro ao buscar CEP:', error);
                    // Mostrar campos mesmo em caso de erro
                    document.getElementById('address-fields').classList.remove('hidden');
                }
            }

            // Event listeners para formatação
            document.getElementById('cpf').addEventListener('input', function(e) {
                e.target.value = formatCPF(e.target.value);
            });

            document.getElementById('phone').addEventListener('input', function(e) {
                e.target.value = formatPhone(e.target.value);
            });

            document.getElementById('zip_code').addEventListener('input', function(e) {
                e.target.value = formatCEP(e.target.value);
                const cleanCEP = e.target.value.replace(/\D/g, '');
                console.log('CEP digitado:', e.target.value, 'Limpo:', cleanCEP);
                
                if (cleanCEP.length === 8) {
                    console.log('CEP completo, buscando endereço...');
                    fetchAddressByCEP(e.target.value);
                } else if (cleanCEP.length > 8) {
                    // Se digitou mais que 8 dígitos, mostrar campos mesmo assim
                    document.getElementById('address-fields').classList.remove('hidden');
                }
            });

            // Controlar exibição dos campos baseado no método de pagamento
            function togglePaymentFields() {
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
            const creditCardFields = document.getElementById('credit-card-fields');
            const pixInfo = document.getElementById('pix-info');
            const boletoInfo = document.getElementById('boleto-info');
            
            // Resetar todos os cards para estado não selecionado
            document.querySelectorAll('.payment-card').forEach(card => {
                card.classList.remove('bg-primary/10', 'border-primary', 'ring-2', 'ring-primary/20');
                card.classList.add('bg-white', 'dark:bg-gray-800', 'border-gray-200', 'dark:border-gray-600');
            });
            
            // Destacar o card selecionado
            const selectedCard = document.getElementById(`card-${paymentMethod}`);
            if (selectedCard) {
                selectedCard.classList.remove('bg-white', 'dark:bg-gray-800', 'border-gray-200', 'dark:border-gray-600');
                selectedCard.classList.add('bg-primary/10', 'border-primary', 'ring-2', 'ring-primary/20');
            }
            
            // Esconder todos os campos
            creditCardFields.classList.add('hidden');
            pixInfo.classList.add('hidden');
            boletoInfo.classList.add('hidden');
            
            // Mostrar campos baseado na seleção
            if (paymentMethod === 'credit_card') {
                creditCardFields.classList.remove('hidden');
            } else if (paymentMethod === 'pix') {
                pixInfo.classList.remove('hidden');
            } else if (paymentMethod === 'boleto') {
                boletoInfo.classList.remove('hidden');
            }
        }
        
        // Adicionar listeners para os radio buttons
        document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
            radio.addEventListener('change', togglePaymentFields);
        });
        
            // Inicializar campos
            togglePaymentFields();
            
            // Verificar se já há dados do CEP para mostrar os campos
            const zipCodeValue = document.getElementById('zip_code').value;
            if (zipCodeValue && zipCodeValue.replace(/\D/g, '').length >= 8) {
                document.getElementById('address-fields').classList.remove('hidden');
            }
            
            // Adicionar listener para mostrar campos quando CEP for válido
            document.getElementById('zip_code').addEventListener('blur', function(e) {
                const cleanCEP = e.target.value.replace(/\D/g, '');
                if (cleanCEP.length >= 8) {
                    document.getElementById('address-fields').classList.remove('hidden');
                }
            });
            
        
        // Função para mostrar modal de loading
        function showLoadingModal() {
            const modal = document.getElementById('loading-modal');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            // Animar progresso dos steps
            animateProgressSteps();
        }
        
        // Função para esconder modal de loading
        function hideLoadingModal() {
            const modal = document.getElementById('loading-modal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        // Função para animar os steps de progresso
        function animateProgressSteps() {
            const steps = document.querySelectorAll('#loading-modal .flex.items-center.space-x-3');
            let currentStep = 0;
            
            console.log('Iniciando animação dos steps:', steps.length);
            
            const interval = setInterval(() => {
                console.log('Step atual:', currentStep);
                
                if (currentStep < steps.length) {
                    // Ativar step atual
                    const currentStepElement = steps[currentStep];
                    const dot = currentStepElement.querySelector('.w-2.h-2');
                    const text = currentStepElement.querySelector('span');
                    
                    if (dot && text) {
                        dot.classList.remove('bg-gray-300', 'dark:bg-gray-600');
                        dot.classList.add('bg-orange-500', 'animate-pulse');
                        text.classList.remove('text-gray-500', 'dark:text-gray-500');
                        text.classList.add('text-gray-600', 'dark:text-gray-400');
                        console.log('Step ativado:', currentStep);
                    }
                    
                    currentStep++;
                } else {
                    console.log('Todos os steps completados');
                    clearInterval(interval);
                }
            }, 1000); // 1 segundo por step para completar em 3 segundos
        }
        
        document.getElementById('checkout-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('submit-btn');
            const originalText = submitBtn.innerHTML;
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
            
            // Validar campos do cartão apenas se cartão for selecionado
            if (paymentMethod === 'credit_card') {
                const cardName = document.getElementById('card_name').value;
                const cardNumber = document.getElementById('card_number').value;
                const expiryDate = document.getElementById('expiry_date').value;
                const cvc = document.getElementById('cvc').value;
                
                if (!cardName || !cardNumber || !expiryDate || !cvc) {
                    alert('Por favor, preencha todos os campos do cartão de crédito.');
                    return;
                }
            }
            
            // Mostrar modal de loading
            console.log('Mostrando modal de loading...');
            showLoadingModal();
            
            // Processar pagamento por exatamente 3 segundos
            setTimeout(() => {
                console.log('Processamento concluído, redirecionando para página de obrigado...');
                hideLoadingModal();
                
                // Redirecionar para página de obrigado
                window.location.href = '/obrigado/1/1'; // Plano 1, Checkout 1
            }, 3000); // Exatamente 3 segundos
        });
    </script>
</body>
</html>