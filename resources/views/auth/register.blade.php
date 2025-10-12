<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $semPlano ? 'Cadastre-se - FitPlan Academy' : 'Cadastro - FitPlan Academy' }}</title>
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
    <!-- Header -->
    <header class="sticky top-0 z-40 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-sm border-b border-zinc-200 dark:border-zinc-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-4">
                    <a href="{{ route('landing') }}" class="flex items-center gap-4">
                        <div class="text-primary size-8">
                            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="currentColor"/>
                                <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" fill="none"/>
                                <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" fill="none"/>
                            </svg>
                        </div>
                        <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">FitPlan Academy</h1>
                    </a>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('landing') }}" class="px-4 py-2 text-sm font-medium text-zinc-600 dark:text-zinc-300 hover:text-primary transition-colors">← Voltar</a>
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-bold text-zinc-600 dark:text-zinc-300 hover:text-primary transition-colors">Entrar</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-16 md:py-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">
                <!-- Header Section -->
                <div class="text-center mb-12">
                    <h1 class="text-4xl md:text-5xl font-black tracking-tight text-zinc-900 dark:text-white mb-4">
                        {{ $semPlano ? 'Cadastre-se' : 'Cadastro' }}
                    </h1>
                    <p class="text-lg text-zinc-600 dark:text-zinc-300 mb-8">
                        {{ $semPlano ? 'Complete seu cadastro e comece sua jornada fitness hoje mesmo!' : 'Crie sua conta no FitPlan Academy' }}
                    </p>
                    
                    @if($errors->any())
                        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-8">
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
                </div>

                <!-- Form -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                    <form method="POST" action="{{ route('auth.register') }}" class="p-8 space-y-6">
                        @csrf
                        
                        <!-- Dados Pessoais -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white border-b border-zinc-200 dark:border-zinc-700 pb-2">Dados Pessoais</h3>
                            
                            <div>
                                <label for="name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Nome Completo *</label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}"
                                       placeholder="Digite seu nome completo"
                                       minlength="8"
                                       maxlength="60"
                                       required
                                       class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Entre 8 e 60 caracteres alfabéticos</p>
                            </div>

                            <div>
                                <label for="birth_date" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Data de Nascimento *</label>
                                <input type="date" 
                                       id="birth_date" 
                                       name="birth_date" 
                                       value="{{ old('birth_date') }}"
                                       required
                                       class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                            </div>

                            <div>
                                <label for="gender" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Sexo *</label>
                                <select id="gender" 
                                        name="gender" 
                                        required
                                        class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                                    <option value="">Selecione o sexo</option>
                                    <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>Masculino</option>
                                    <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>Feminino</option>
                                    <option value="O" {{ old('gender') == 'O' ? 'selected' : '' }}>Outro</option>
                                </select>
                            </div>

                            <div>
                                <label for="mother_name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Nome da Mãe *</label>
                                <input type="text" 
                                       id="mother_name" 
                                       name="mother_name" 
                                       value="{{ old('mother_name') }}"
                                       placeholder="Nome completo da mãe"
                                       minlength="8"
                                       maxlength="60"
                                       required
                                       class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                            </div>

                            <div>
                                <label for="cpf" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">CPF *</label>
                                <input type="text" 
                                       id="cpf" 
                                       name="cpf" 
                                       value="{{ old('cpf') }}"
                                       placeholder="000.000.000-00"
                                       maxlength="14"
                                       required
                                       class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Será validado com dígito verificador</p>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">E-mail *</label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}"
                                       placeholder="seu@email.com"
                                       required
                                       class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="phone_cell" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Telefone Celular *</label>
                                    <input type="tel" 
                                           id="phone_cell" 
                                           name="phone_cell" 
                                           value="{{ old('phone_cell') }}"
                                           placeholder="(+55)11-99999-9999"
                                           maxlength="16"
                                           required
                                           class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                                </div>
                                <div>
                                    <label for="phone_fixed" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Telefone Fixo *</label>
                                    <input type="tel" 
                                           id="phone_fixed" 
                                           name="phone_fixed" 
                                           value="{{ old('phone_fixed') }}"
                                           placeholder="(+55)11-3333-4444"
                                           maxlength="16"
                                           required
                                           class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                                </div>
                            </div>
                        </div>

                        <!-- Endereço -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white border-b border-zinc-200 dark:border-zinc-700 pb-2">Endereço Completo</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-1">
                                    <label for="cep" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">CEP *</label>
                                    <input type="text" 
                                           id="cep" 
                                           name="cep" 
                                           value="{{ old('cep') }}"
                                           placeholder="00000-000"
                                           maxlength="9"
                                           required
                                           class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Preenchimento automático via ViaCEP</p>
                                </div>
                                <div class="md:col-span-1">
                                    <label for="street" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Logradouro *</label>
                                    <input type="text" 
                                           id="street" 
                                           name="street" 
                                           value="{{ old('street') }}"
                                           placeholder="Nome da rua/avenida"
                                           required
                                           class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="number" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Número *</label>
                                    <input type="text" 
                                           id="number" 
                                           name="number" 
                                           value="{{ old('number') }}"
                                           placeholder="123"
                                           required
                                           class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                                </div>
                                <div>
                                    <label for="complement" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Complemento *</label>
                                    <input type="text" 
                                           id="complement" 
                                           name="complement" 
                                           value="{{ old('complement') }}"
                                           placeholder="Apto 45, Bloco A, etc."
                                           required
                                           class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                                </div>
                            </div>

                            <div>
                                <label for="district" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Bairro *</label>
                                <input type="text" 
                                       id="district" 
                                       name="district" 
                                       value="{{ old('district') }}"
                                       placeholder="Nome do bairro"
                                       required
                                       class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="city" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Cidade *</label>
                                    <input type="text" 
                                           id="city" 
                                           name="city" 
                                           value="{{ old('city') }}"
                                           placeholder="Nome da cidade"
                                           required
                                           class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                                </div>
                                <div>
                                    <label for="state" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Estado *</label>
                                    <input type="text" 
                                           id="state" 
                                           name="state" 
                                           value="{{ old('state') }}"
                                           placeholder="SP"
                                           maxlength="2"
                                           required
                                           class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                                </div>
                            </div>
                        </div>

                        <!-- Dados de Acesso -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white border-b border-zinc-200 dark:border-zinc-700 pb-2">Dados de Acesso</h3>
                            
                            <div>
                                <label for="login" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Login *</label>
                                <div class="relative">
                                    <input type="text" 
                                           id="login" 
                                           name="login" 
                                           value="{{ old('login') }}"
                                           placeholder="EXEMPLO"
                                           minlength="6"
                                           maxlength="6"
                                           pattern="[A-Za-z]{6}"
                                           required
                                           class="w-full px-4 py-3 pr-10 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                                    <div id="login-check" class="absolute right-3 top-1/2 transform -translate-y-1/2 hidden">
                                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div id="login-hint" class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span id="login-count">0</span>/6 caracteres alfabéticos
                                        <span id="login-status" class="text-xs"></span>
                                    </div>
                                    <div id="login-examples" class="text-xs text-zinc-400 dark:text-zinc-500">
                                        <span class="block">Exemplos válidos: EXEMPLO, ABCDEF, LOGIN1</span>
                                        <span class="block">❌ Não use: números, símbolos ou espaços</span>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="password" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Senha *</label>
                                    <div class="relative">
                                        <input type="password" 
                                               id="password" 
                                               name="password"
                                               placeholder="Mínimo 8 caracteres alfabéticos"
                                               minlength="8"
                                               pattern="[A-Za-z]{8,}"
                                               required
                                               class="w-full px-4 py-3 pr-20 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                                        
                                        <!-- Botão de mostrar/ocultar senha -->
                                        <button type="button" 
                                                id="password-toggle" 
                                                class="absolute right-10 top-1/2 transform -translate-y-1/2 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300 transition-colors"
                                                onclick="togglePasswordVisibility('password')">
                                            <svg id="password-eye" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            <svg id="password-eye-slash" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                            </svg>
                                        </button>
                                        
                                        <!-- Checkmark de validação -->
                                        <div id="password-check" class="absolute right-3 top-1/2 transform -translate-y-1/2 hidden">
                                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div id="password-hint" class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span id="password-count">0</span>/8 caracteres alfabéticos
                                            <span id="password-status" class="text-xs"></span>
                                        </div>
                                        <div id="password-examples" class="text-xs text-zinc-400 dark:text-zinc-500">
                                            <span class="block">✅ Exemplos válidos: MINHASENHA, ABCDEFGH, PASSWORD</span>
                                            <span class="block">🔒 A senha será armazenada de forma criptografada</span>
                                            <span class="block">❌ Não use: números, símbolos ou espaços</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Confirmação da Senha *</label>
                                    <div class="relative">
                                        <input type="password" 
                                               id="password_confirmation" 
                                               name="password_confirmation"
                                               placeholder="Digite a senha novamente"
                                               minlength="8"
                                               required
                                               class="w-full px-4 py-3 pr-20 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                                               
                                        <!-- Botão de mostrar/ocultar senha -->
                                        <button type="button" 
                                                id="password-confirm-toggle" 
                                                class="absolute right-10 top-1/2 transform -translate-y-1/2 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300 transition-colors"
                                                onclick="togglePasswordVisibility('password_confirmation')">
                                            <svg id="password-confirm-eye" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            <svg id="password-confirm-eye-slash" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                            </svg>
                                        </button>
                                               
                                        <div id="password-confirm-check" class="absolute right-3 top-1/2 transform -translate-y-1/2 hidden">
                                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div id="password-confirm-hint" class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span id="password-confirm-status" class="text-xs"></span>
                                        </div>
                                        <div class="text-xs text-zinc-400 dark:text-zinc-500">
                                            <span class="block">✅ Deve ser idêntica à senha acima</span>
                                            <span class="block">🔒 Ambas as senhas serão criptografadas</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-6">
                            <button type="submit" class="w-full bg-primary text-white font-semibold py-4 px-6 rounded-lg hover:bg-primary/90 transition-colors">
                                Cadastrar-se na FitPlan Academy
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="text-center mt-8">
                    <p class="text-zinc-600 dark:text-zinc-400">
                        Já tem uma conta? 
                        <a href="{{ route('login') }}" class="text-primary hover:text-primary/80 font-medium transition-colors">Faça login aqui</a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-zinc-900 dark:bg-black py-8 mt-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center text-zinc-400">
            <p>&copy; 2024 FitPlan Academy. Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- JavaScript para máscaras e validações -->
    <script>
        // Função para validar CPF
        function validarCPF(cpf) {
            cpf = cpf.replace(/[^\d]/g, '');
            if (cpf.length !== 11) return false;
            
            // Verificar se todos os dígitos são iguais
            if (/^(\d)\1{10}$/.test(cpf)) return false;
            
            // Validar primeiro dígito verificador
            let soma = 0;
            for (let i = 0; i < 9; i++) {
                soma += parseInt(cpf.charAt(i)) * (10 - i);
            }
            let resto = 11 - (soma % 11);
            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.charAt(9))) return false;
            
            // Validar segundo dígito verificador
            soma = 0;
            for (let i = 0; i < 10; i++) {
                soma += parseInt(cpf.charAt(i)) * (11 - i);
            }
            resto = 11 - (soma % 11);
            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.charAt(10))) return false;
            
            return true;
        }

        // Máscara para CPF com validação
        document.getElementById('cpf').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
            e.target.value = value;
            
            // Validar CPF quando completo
            if (value.length === 14) {
                if (!validarCPF(value)) {
                    e.target.setCustomValidity('CPF inválido');
                    e.target.reportValidity();
                } else {
                    e.target.setCustomValidity('');
                }
            }
        });

        // Máscara para telefone celular
        document.getElementById('phone_cell').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/(\d{2})(\d{5})(\d{4})/, '(+55)$1-$2-$3');
            }
            e.target.value = value;
        });

        // Máscara para telefone fixo
        document.getElementById('phone_fixed').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 10) {
                value = value.replace(/(\d{2})(\d{4})(\d{4})/, '(+55)$1-$2-$3');
            }
            e.target.value = value;
        });

        // Máscara para CEP com busca automática
        document.getElementById('cep').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/(\d{5})(\d{3})/, '$1-$2');
            e.target.value = value;
            
            // Buscar endereço pelo CEP
            if (value.length === 9) {
                fetch(`https://viacep.com.br/ws/${value.replace('-', '')}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.erro) {
                            document.getElementById('street').value = data.logradouro || '';
                            document.getElementById('district').value = data.bairro || '';
                            document.getElementById('city').value = data.localidade || '';
                            document.getElementById('state').value = data.uf || '';
                        } else {
                            console.log('CEP não encontrado');
                        }
                    })
                    .catch(error => {
                        console.log('Erro ao buscar CEP:', error);
                        // Permitir preenchimento manual em caso de erro
                    });
            }
        });

        // Máscara para estado (uppercase)
        document.getElementById('state').addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase();
        });

        // Validação em tempo real para LOGIN
        const loginInput = document.getElementById('login');
        const loginCheck = document.getElementById('login-check');
        const loginCount = document.getElementById('login-count');
        const loginStatus = document.getElementById('login-status');
        const loginHint = document.getElementById('login-hint');

        loginInput.addEventListener('input', function(e) {
            // Aplicar máscara (uppercase e apenas letras)
            e.target.value = e.target.value.replace(/[^A-Za-z]/g, '').toUpperCase();
            
            const value = e.target.value;
            const count = value.length;
            
            // Atualizar contador
            loginCount.textContent = count;
            
            // Atualizar status
            if (count === 0) {
                loginStatus.textContent = '';
                loginStatus.className = 'text-xs';
            } else if (count < 6) {
                loginStatus.textContent = `Faltam ${6 - count} caracteres`;
                loginStatus.className = 'text-xs text-orange-500';
            } else if (count === 6 && /^[A-Za-z]{6}$/.test(value)) {
                loginStatus.textContent = '✅ Perfeito!';
                loginStatus.className = 'text-xs text-green-600';
            } else {
                loginStatus.textContent = '❌ Muito longo';
                loginStatus.className = 'text-xs text-red-500';
            }
            
            // Validar e mostrar checkmark
            if (count === 6 && /^[A-Za-z]{6}$/.test(value)) {
                loginCheck.classList.remove('hidden');
                loginHint.classList.remove('text-zinc-500', 'dark:text-zinc-400');
                loginHint.classList.add('text-green-600', 'dark:text-green-400');
                e.target.classList.remove('border-red-500');
                e.target.classList.add('border-green-500');
            } else {
                loginCheck.classList.add('hidden');
                loginHint.classList.remove('text-green-600', 'dark:text-green-400');
                loginHint.classList.add('text-zinc-500', 'dark:text-zinc-400');
                e.target.classList.remove('border-green-500');
                if (count > 0) {
                    e.target.classList.add('border-red-500');
                } else {
                    e.target.classList.remove('border-red-500');
                }
            }
        });

        // Validação em tempo real para SENHA
        const passwordInput = document.getElementById('password');
        const passwordCheck = document.getElementById('password-check');
        const passwordCount = document.getElementById('password-count');
        const passwordStatus = document.getElementById('password-status');
        const passwordHint = document.getElementById('password-hint');

        passwordInput.addEventListener('input', function(e) {
            // Aplicar máscara (apenas letras)
            e.target.value = e.target.value.replace(/[^A-Za-z]/g, '');
            
            const value = e.target.value;
            const count = value.length;
            
            // Atualizar contador
            passwordCount.textContent = count;
            
            // Atualizar status
            if (count === 0) {
                passwordStatus.textContent = '';
                passwordStatus.className = 'text-xs';
            } else if (count < 8) {
                passwordStatus.textContent = `Faltam ${8 - count} caracteres`;
                passwordStatus.className = 'text-xs text-orange-500';
            } else if (count >= 8 && /^[A-Za-z]{8,}$/.test(value)) {
                passwordStatus.textContent = '✅ Senha válida!';
                passwordStatus.className = 'text-xs text-green-600';
            } else {
                passwordStatus.textContent = '❌ Use apenas letras';
                passwordStatus.className = 'text-xs text-red-500';
            }
            
            // Validar e mostrar checkmark
            if (count >= 8 && /^[A-Za-z]{8,}$/.test(value)) {
                passwordCheck.classList.remove('hidden');
                passwordHint.classList.remove('text-zinc-500', 'dark:text-zinc-400');
                passwordHint.classList.add('text-green-600', 'dark:text-green-400');
                e.target.classList.remove('border-red-500');
                e.target.classList.add('border-green-500');
            } else {
                passwordCheck.classList.add('hidden');
                passwordHint.classList.remove('text-green-600', 'dark:text-green-400');
                passwordHint.classList.add('text-zinc-500', 'dark:text-zinc-400');
                e.target.classList.remove('border-green-500');
                if (count > 0) {
                    e.target.classList.add('border-red-500');
                } else {
                    e.target.classList.remove('border-red-500');
                }
            }
            
            // Revalidar confirmação se já foi preenchida
            const confirmation = document.getElementById('password_confirmation');
            if (confirmation.value) {
                confirmation.dispatchEvent(new Event('input'));
            }
        });

        // Validação em tempo real para CONFIRMAÇÃO DE SENHA
        const passwordConfirmInput = document.getElementById('password_confirmation');
        const passwordConfirmCheck = document.getElementById('password-confirm-check');
        const passwordConfirmStatus = document.getElementById('password-confirm-status');
        const passwordConfirmHint = document.getElementById('password-confirm-hint');

        passwordConfirmInput.addEventListener('input', function(e) {
            // Aplicar máscara (apenas letras)
            e.target.value = e.target.value.replace(/[^A-Za-z]/g, '');
            
            const password = passwordInput.value;
            const confirmation = e.target.value;
            
            // Atualizar status
            if (confirmation.length === 0) {
                passwordConfirmStatus.textContent = '';
                passwordConfirmStatus.className = 'text-xs';
            } else if (confirmation.length < 8) {
                passwordConfirmStatus.textContent = `Faltam ${8 - confirmation.length} caracteres`;
                passwordConfirmStatus.className = 'text-xs text-orange-500';
            } else if (password === confirmation && password.length >= 8) {
                passwordConfirmStatus.textContent = '✅ Senhas coincidem!';
                passwordConfirmStatus.className = 'text-xs text-green-600';
            } else {
                passwordConfirmStatus.textContent = '❌ Senhas não coincidem';
                passwordConfirmStatus.className = 'text-xs text-red-500';
            }
            
            // Validar e mostrar checkmark
            if (confirmation.length >= 8 && password === confirmation && password.length >= 8) {
                passwordConfirmCheck.classList.remove('hidden');
                passwordConfirmHint.classList.remove('text-zinc-500', 'dark:text-zinc-400');
                passwordConfirmHint.classList.add('text-green-600', 'dark:text-green-400');
                e.target.classList.remove('border-red-500');
                e.target.classList.add('border-green-500');
                e.target.setCustomValidity('');
            } else {
                passwordConfirmCheck.classList.add('hidden');
                passwordConfirmHint.classList.remove('text-green-600', 'dark:text-green-400');
                passwordConfirmHint.classList.add('text-zinc-500', 'dark:text-zinc-400');
                e.target.classList.remove('border-green-500');
                if (confirmation.length > 0) {
                    e.target.classList.add('border-red-500');
                    e.target.setCustomValidity('As senhas não coincidem');
                } else {
                    e.target.classList.remove('border-red-500');
                    e.target.setCustomValidity('');
                }
            }
        });

        // Função para mostrar/ocultar senha
        function togglePasswordVisibility(fieldId) {
            const field = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(fieldId + '-eye');
            const eyeSlashIcon = document.getElementById(fieldId + '-eye-slash');
            
            if (field.type === 'password') {
                field.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeSlashIcon.classList.remove('hidden');
            } else {
                field.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeSlashIcon.classList.add('hidden');
            }
        }

        // Validação de nome (apenas letras e espaços)
        document.getElementById('name').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^A-Za-zÀ-ÿ\s]/g, '');
        });

        // Validação de nome da mãe (apenas letras e espaços)
        document.getElementById('mother_name').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^A-Za-zÀ-ÿ\s]/g, '');
        });
    </script>
</div>
</body>
</html>