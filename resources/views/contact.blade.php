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
    <!-- Barra de Acessibilidade -->
    @include('components.accessibility-bar')
    
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
                    value = `(${value}`;
                } else if (value.length <= 6) {
                    value = `(${value.slice(0, 2)}) ${value.slice(2)}`;
                } else if (value.length <= 10) {
                    value = `(${value.slice(0, 2)}) ${value.slice(2, 6)}-${value.slice(6)}`;
                } else {
                    value = `(${value.slice(0, 2)}) ${value.slice(2, 7)}-${value.slice(7, 11)}`;
                }
            }
            e.target.value = value;
        });
    }
});
</script>
</body>
</html>