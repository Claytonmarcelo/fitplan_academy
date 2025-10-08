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
                            <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                <path d="M42.1739 20.1739L27.8261 5.82609C29.1366 7.13663 28.3989 10.1876 26.2002 13.7654C24.8538 15.9564 22.9595 18.3449 20.6522 20.6522C18.3449 22.9595 15.9564 24.8538 13.7654 26.2002C10.1876 28.3989 7.13663 29.1366 5.82609 27.8261L20.1739 42.1739C21.4845 43.4845 24.5355 42.7467 28.1133 40.548C30.3042 39.2016 32.6927 37.3073 35 35C37.3073 32.6927 39.2016 30.3042 40.548 28.1133C42.7467 24.5355 43.4845 21.4845 42.1739 20.1739Z" fill="currentColor"></path>
                                <path clip-rule="evenodd" d="M7.24189 26.4066C7.31369 26.4411 7.64204 26.5637 8.52504 26.3738C9.59462 26.1438 11.0343 25.5311 12.7183 24.4963C14.7583 23.2426 17.0256 21.4503 19.238 19.238C21.4503 17.0256 23.2426 14.7583 24.4963 12.7183C25.5311 11.0343 26.1438 9.59463 26.3738 8.52504C26.5637 7.64204 26.4411 7.31369 26.4066 7.24189C26.345 7.21246 26.143 7.14535 25.6664 7.1918C24.9745 7.25925 23.9954 7.5498 22.7699 8.14278C20.3369 9.32007 17.3369 11.4915 14.4142 14.4142C11.4915 17.3369 9.32007 20.3369 8.14278 22.7699C7.5498 23.9954 7.25925 24.9745 7.1918 25.6664C7.14534 26.143 7.21246 26.345 7.24189 26.4066ZM29.9001 10.7285C29.4519 12.0322 28.7617 13.4172 27.9042 14.8126C26.465 17.1544 24.4686 19.6641 22.0664 22.0664C19.6641 24.4686 17.1544 26.465 14.8126 27.9042C13.4172 28.7617 12.0322 29.4519 10.7285 29.9001L21.5754 40.747C21.6001 40.7606 21.8995 40.931 22.8729 40.7217C23.9424 40.4916 25.3821 39.879 27.0661 38.8441C29.1062 37.5904 31.3734 35.7982 33.5858 33.5858C35.7982 31.3734 37.5904 29.1062 38.8441 27.0661C39.879 25.3821 40.4916 23.9425 40.7216 22.8729C40.931 21.8995 40.7606 21.6001 40.747 21.5754L29.9001 10.7285ZM29.2403 4.41187L43.5881 18.7597C44.9757 20.1473 44.9743 22.1235 44.6322 23.7139C44.2714 25.3919 43.4158 27.2666 42.252 29.1604C40.8128 31.5022 38.8165 34.012 36.4142 36.4142C34.012 38.8165 31.5022 40.8128 29.1604 42.252C27.2666 43.4158 25.3919 44.2714 23.7139 44.6322C22.1235 44.9743 20.1473 44.9757 18.7597 43.5881L4.41187 29.2403C3.29027 28.1187 3.08209 26.5973 3.21067 25.2783C3.34099 23.9415 3.8369 22.4852 4.54214 21.0277C5.96129 18.0948 8.43335 14.7382 11.5858 11.5858C14.7382 8.43335 18.0948 5.9613 21.0277 4.54214C22.4852 3.8369 23.9415 3.34099 25.2783 3.21067C26.5973 3.08209 28<｜tool▁call▁begin｜>118.117.1137 3.29028 29.2403 4.41187Z" fill="currentColor" fill-rule="evenodd"></path>
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
                                <input type="text" 
                                       id="login" 
                                       name="login" 
                                       value="{{ old('login') }}"
                                       placeholder="EXEMPLO"
                                       minlength="6"
                                       maxlength="6"
                                       pattern="[A-Za-z]{6}"
                                       required
                                       class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Exatamente 6 caracteres alfabéticos</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="password" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Senha *</label>
                                    <input type="password" 
                                           id="password" 
                                           name="password"
                                           placeholder="Mínimo 8 caracteres alfabéticos"
                                           minlength="8"
                                           pattern="[A-Za-z]{8,}"
                                           required
                                           class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">8 caracteres alfabéticos</p>
                                </div>
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Confirmação da Senha *</label>
                                    <input type="password" 
                                           id="password_confirmation" 
                                           name="password_confirmation"
                                           placeholder="Digite a senha novamente"
                                           minlength="8"
                                           required
                                           class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Deve ser idêntica à senha</p>
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

        // Máscara para login (uppercase e apenas letras)
        document.getElementById('login').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^A-Za-z]/g, '').toUpperCase();
        });

        // Validação de senha e confirmação
        document.getElementById('password_confirmation').addEventListener('input', function(e) {
            const password = document.getElementById('password').value;
            const confirmation = e.target.value;
            
            if (password !== confirmation) {
                e.target.setCustomValidity('As senhas não coincidem');
                e.target.reportValidity();
            } else {
                e.target.setCustomValidity('');
            }
        });

        // Validação de nome (apenas letras e espaços)
        document.getElementById('name').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^A-Za-zÀ-ÿ\s]/g, '');
        });

        // Validação de nome da mãe (apenas letras e espaços)
        document.getElementById('mother_name').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^A-Za-zÀ-ÿ\s]/g, '');
        });

        // Validação de senha (apenas letras)
        document.getElementById('password').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^A-Za-z]/g, '');
            
            // Revalidar confirmação se já foi preenchida
            const confirmation = document.getElementById('password_confirmation');
            if (confirmation.value) {
                confirmation.dispatchEvent(new Event('input'));
            }
        });

        // Validação de confirmação de senha (apenas letras)
        document.getElementById('password_confirmation').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^A-Za-z]/g, '');
        });
    </script>
</div>
</body>
</html>