<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato - FitPlan Academy</title>
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
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .dropdown-menu {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        .dropdown-arrow {
            transition: transform 0.3s ease;
        }
        
        .dropdown-item {
            transition: all 0.2s ease;
        }
        
        .custom-shadow {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        @media (prefers-color-scheme: dark) {
            .custom-shadow {
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.1);
            }
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-zinc-900 dark:text-zinc-200">
<div class="min-h-screen">
    <!-- Header Completo com Submenus -->
    @include('components.header-working')

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary/10 to-primary/5 py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-zinc-900 dark:text-white mb-6">
                    Entre em <span class="text-primary">Contato</span>
                </h1>
                <p class="text-lg text-zinc-600 dark:text-zinc-400 mb-8">
                    Estamos aqui para ajudar você a alcançar seus objetivos fitness. 
                    Envie sua mensagem e entraremos em contato em breve.
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-12">
                    <!-- Contact Form -->
                    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-8">
                        <h2 class="text-2xl font-bold text-zinc-900 dark:text-white mb-6">
                            Envie sua Mensagem
                        </h2>
                        
                        @if(session('success'))
                            <div class="mb-6 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg border border-green-400 dark:border-green-700">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="mb-6 p-4 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 rounded-lg border border-red-400 dark:border-red-700">
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                            @csrf
                            
                            <!-- Nome -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                    Nome Completo *
                                </label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}"
                                       required
                                       minlength="2"
                                       maxlength="100"
                                       class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 transition-colors">
                            </div>

                            <!-- E-mail -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                    E-mail *
                                </label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}"
                                       required
                                       maxlength="255"
                                       class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 transition-colors">
                            </div>

                            <!-- Telefone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                    Telefone
                                </label>
                                <input type="tel" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone') }}"
                                       maxlength="20"
                                       placeholder="(+55) 11 99999-9999"
                                       class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 transition-colors">
                            </div>

                            <!-- Assunto -->
                            <div>
                                <label for="subject" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                    Assunto *
                                </label>
                                <input type="text" 
                                       id="subject" 
                                       name="subject" 
                                       value="{{ old('subject') }}"
                                       required
                                       minlength="5"
                                       maxlength="200"
                                       placeholder="Ex: Dúvidas sobre planos, agendamento de avaliação..."
                                       class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 transition-colors">
                            </div>

                            <!-- Mensagem -->
                            <div>
                                <label for="message" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                    Mensagem *
                                </label>
                                <textarea id="message" 
                                          name="message" 
                                          rows="6"
                                          required
                                          minlength="10"
                                          maxlength="2000"
                                          placeholder="Descreva sua dúvida ou solicitação..."
                                          class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 transition-colors resize-none">{{ old('message') }}</textarea>
                            </div>

                            <!-- Botão Enviar -->
                            <button type="submit" 
                                    class="w-full bg-primary hover:bg-primary/90 text-white font-semibold py-3 px-6 rounded-lg transition-colors focus:ring-2 focus:ring-primary focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-zinc-800">
                                Enviar Mensagem
                            </button>
                        </form>
                    </div>

                    <!-- Contact Info -->
                    <div class="space-y-8">
                        <!-- Informações de Contato -->
                        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-8">
                            <h3 class="text-xl font-bold text-zinc-900 dark:text-white mb-6">
                                Informações de Contato
                            </h3>
                            
                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <div class="text-primary mt-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-zinc-900 dark:text-white">E-mail</p>
                                        <p class="text-zinc-600 dark:text-zinc-400">contato@fitplanacademy.com</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="text-primary mt-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-zinc-900 dark:text-white">Telefone</p>
                                        <p class="text-zinc-600 dark:text-zinc-400">(+55) 11 99999-9999</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="text-primary mt-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-zinc-900 dark:text-white">Endereço</p>
                                        <p class="text-zinc-600 dark:text-zinc-400">
                                            Av. Paulista, 1000 - Bela Vista<br>
                                            São Paulo - SP, 01310-100
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Horários de Funcionamento -->
                        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-8">
                            <h3 class="text-xl font-bold text-zinc-900 dark:text-white mb-6">
                                Horários de Funcionamento
                            </h3>
                            
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-zinc-600 dark:text-zinc-400">Segunda - Sexta</span>
                                    <span class="font-medium text-zinc-900 dark:text-white">06:00 - 23:00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-zinc-600 dark:text-zinc-400">Sábado</span>
                                    <span class="font-medium text-zinc-900 dark:text-white">07:00 - 21:00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-zinc-600 dark:text-zinc-400">Domingo</span>
                                    <span class="font-medium text-zinc-900 dark:text-white">08:00 - 20:00</span>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Rápido -->
                        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-8">
                            <h3 class="text-xl font-bold text-zinc-900 dark:text-white mb-6">
                                Perguntas Frequentes
                            </h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <p class="font-medium text-zinc-900 dark:text-white mb-1">
                                        Como faço para cancelar meu plano?
                                    </p>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                        Entre em contato conosco com pelo menos 7 dias de antecedência.
                                    </p>
                                </div>
                                
                                <div>
                                    <p class="font-medium text-zinc-900 dark:text-white mb-1">
                                        Posso congelar minha mensalidade?
                                    </p>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                        Sim, oferecemos congelamento por até 30 dias por ano.
                                    </p>
                                </div>
                                
                                <div>
                                    <p class="font-medium text-zinc-900 dark:text-white mb-1">
                                        Há avaliação física gratuita?
                                    </p>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                        Sim, todos os novos alunos recebem avaliação física completa.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rodapé Completo -->
    @include('components.footer')
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="text-primary size-8">
                            <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                <path d="M42.1739 20.1739L27.8261 5.82609C29.1366 7.13663 28.3989 10.1876 26.2002 13.7654C24.8538 15.9564 22.9595 18.3449 20.6522 20.6522C18.3449 22.9595 15.9564 24.8538 13.7654 26.2002C10.1876 28.3989 7.13663 29.1366 5.82609 27.8261L20.1739 42.1739C21.4845 43.4845 24.5355 42.7467 28.1133 40.548C30.3042 39.2016 32.6927 37.3073 35 35C37.3073 32.6927 39.2016 30.3042 40.548 28.1133C42.7467 24.5355 43.4845 21.4845 42.1739 20.1739Z" fill="currentColor"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold">FitPlan Academy</h3>
                    </div>
                    <p class="text-zinc-400 text-sm">
                        Transformando vidas através do fitness com excelência e dedicação.
                    </p>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Links Rápidos</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('landing') }}" class="text-zinc-400 hover:text-white transition-colors">Home</a></li>
                        <li><a href="{{ route('landing') }}#planos" class="text-zinc-400 hover:text-white transition-colors">Planos</a></li>
                        <li><a href="{{ route('units.index') }}" class="text-zinc-400 hover:text-white transition-colors">Unidades</a></li>
                        <li><a href="{{ route('contact') }}" class="text-zinc-400 hover:text-white transition-colors">Contato</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Contato</h4>
                    <ul class="space-y-2 text-sm text-zinc-400">
                        <li>contato@fitplanacademy.com</li>
                        <li>(+55) 11 99999-9999</li>
                        <li>Av. Paulista, 1000</li>
                        <li>São Paulo - SP</li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Redes Sociais</h4>
                    <div class="flex gap-4">
                        <a href="#" class="text-zinc-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-zinc-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-zinc-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
    <!-- Rodapé Completo -->
    @include('components.footer')
</div>

<!-- JavaScript para máscaras -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Máscara para telefone
    const phoneInput = document.getElementById('phone');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (value.length <= 2) {
                    value = `(+55)${value}`;
                } else if (value.length <= 7) {
                    value = `(+55)${value.slice(2)}`;
                } else if (value.length <= 11) {
                    value = `(+55)${value.slice(2, 4)}-${value.slice(4)}`;
                } else {
                    value = `(+55)${value.slice(2, 4)}-${value.slice(4, 9)}-${value.slice(9, 13)}`;
                }
            }
            e.target.value = value;
        });
    }
});
</script>
</body>
</html>
