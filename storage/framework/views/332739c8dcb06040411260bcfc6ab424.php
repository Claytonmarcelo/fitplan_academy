<?php $__env->startSection('title', 'FAQ - Perguntas Frequentes - FitPlan Academy'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-background-light dark:bg-zinc-900">
    <!-- Header -->
    <div class="bg-white dark:bg-zinc-800 shadow-sm">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-zinc-900 dark:text-white mb-4">
                    Perguntas Frequentes
                </h1>
                <p class="text-zinc-600 dark:text-zinc-400">
                    Encontre respostas para as dúvidas mais comuns sobre nossos serviços
                </p>
            </div>
        </div>
    </div>

    <!-- Conteúdo -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-4xl mx-auto">
            
            <!-- Busca -->
            <div class="mb-8">
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm p-6">
                    <div class="relative">
                        <input type="text" 
                               placeholder="Buscar perguntas..." 
                               class="w-full px-4 py-3 pl-10 pr-4 text-zinc-900 dark:text-white bg-zinc-50 dark:bg-zinc-700 border border-zinc-200 dark:border-zinc-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <svg class="absolute left-3 top-3.5 h-5 w-5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Categorias -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm p-6 text-center">
                    <div class="text-primary mb-4">
                        <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">Planos</h3>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400">Dúvidas sobre nossos planos</p>
                </div>
                
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm p-6 text-center">
                    <div class="text-primary mb-4">
                        <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">Unidades</h3>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400">Informações sobre nossas unidades</p>
                </div>
                
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm p-6 text-center">
                    <div class="text-primary mb-4">
                        <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">Pagamentos</h3>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400">Questões sobre cobrança</p>
                </div>
            </div>

            <!-- FAQ Accordion -->
            <div class="space-y-4">
                
                <!-- Planos -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm">
                    <h2 class="text-xl font-semibold text-zinc-900 dark:text-white p-6 border-b border-zinc-200 dark:border-zinc-700">
                        📋 Planos e Serviços
                    </h2>
                    
                    <div class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        <!-- Pergunta 1 -->
                        <div class="p-6">
                            <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ('faq1')">
                                <h3 class="text-lg font-medium text-zinc-900 dark:text-white">
                                    Quais são os planos disponíveis?
                                </h3>
                                <svg class="w-5 h-5 text-zinc-500 transform transition-transform" id="faq1-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="mt-4 text-zinc-600 dark:text-zinc-300 hidden" id="faq1-content">
                                <p>Oferecemos três planos principais:</p>
                                <ul class="list-disc list-inside mt-2 space-y-1">
                                    <li><strong>Basic:</strong> Acesso às instalações e equipamentos básicos</li>
                                    <li><strong>Smart:</strong> Inclui aulas em grupo e orientação nutricional</li>
                                    <li><strong>Black:</strong> Plano premium com personal trainer e todos os benefícios</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Pergunta 2 -->
                        <div class="p-6">
                            <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ('faq2')">
                                <h3 class="text-lg font-medium text-zinc-900 dark:text-white">
                                    Posso trocar de plano a qualquer momento?
                                </h3>
                                <svg class="w-5 h-5 text-zinc-500 transform transition-transform" id="faq2-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="mt-4 text-zinc-600 dark:text-zinc-300 hidden" id="faq2-content">
                                <p>Sim! Você pode fazer upgrade ou downgrade do seu plano a qualquer momento. 
                                As alterações entram em vigor no próximo ciclo de cobrança.</p>
                            </div>
                        </div>

                        <!-- Pergunta 3 -->
                        <div class="p-6">
                            <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ('faq3')">
                                <h3 class="text-lg font-medium text-zinc-900 dark:text-white">
                                    Os planos incluem aulas em grupo?
                                </h3>
                                <svg class="w-5 h-5 text-zinc-500 transform transition-transform" id="faq3-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="mt-4 text-zinc-600 dark:text-zinc-300 hidden" id="faq3-content">
                                <p>As aulas em grupo estão incluídas nos planos Smart e Black. 
                                O plano Basic oferece acesso apenas às instalações e equipamentos.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Unidades -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm">
                    <h2 class="text-xl font-semibold text-zinc-900 dark:text-white p-6 border-b border-zinc-200 dark:border-zinc-700">
                        🏢 Unidades e Instalações
                    </h2>
                    
                    <div class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        <!-- Pergunta 4 -->
                        <div class="p-6">
                            <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ('faq4')">
                                <h3 class="text-lg font-medium text-zinc-900 dark:text-white">
                                    Quantas unidades vocês possuem?
                                </h3>
                                <svg class="w-5 h-5 text-zinc-500 transform transition-transform" id="faq4-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="mt-4 text-zinc-600 dark:text-zinc-300 hidden" id="faq4-content">
                                <p>Atualmente temos 3 unidades em São Paulo:</p>
                                <ul class="list-disc list-inside mt-2 space-y-1">
                                    <li><strong>Centro:</strong> Av. Paulista, 1000 - Bela Vista</li>
                                    <li><strong>Zona Sul:</strong> Rua Augusta, 500 - Jardins</li>
                                    <li><strong>Zona Oeste:</strong> Av. Faria Lima, 2000 - Itaim Bibi</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Pergunta 5 -->
                        <div class="p-6">
                            <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ('faq5')">
                                <h3 class="text-lg font-medium text-zinc-900 dark:text-white">
                                    Posso usar qualquer unidade com meu plano?
                                </h3>
                                <svg class="w-5 h-5 text-zinc-500 transform transition-transform" id="faq5-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="mt-4 text-zinc-600 dark:text-zinc-300 hidden" id="faq5-content">
                                <p>Sim! Todos os planos permitem acesso a qualquer uma de nossas unidades. 
                                Você pode treinar na unidade que for mais conveniente para você.</p>
                            </div>
                        </div>

                        <!-- Pergunta 6 -->
                        <div class="p-6">
                            <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ('faq6')">
                                <h3 class="text-lg font-medium text-zinc-900 dark:text-white">
                                    Quais são os horários de funcionamento?
                                </h3>
                                <svg class="w-5 h-5 text-zinc-500 transform transition-transform" id="faq6-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="mt-4 text-zinc-600 dark:text-zinc-300 hidden" id="faq6-content">
                                <p>Todas as unidades funcionam:</p>
                                <ul class="list-disc list-inside mt-2 space-y-1">
                                    <li><strong>Segunda a Sexta:</strong> 6h às 23h</li>
                                    <li><strong>Sábados:</strong> 7h às 20h</li>
                                    <li><strong>Domingos:</strong> 8h às 18h</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagamentos -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm">
                    <h2 class="text-xl font-semibold text-zinc-900 dark:text-white p-6 border-b border-zinc-200 dark:border-zinc-700">
                        💳 Pagamentos e Cobrança
                    </h2>
                    
                    <div class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        <!-- Pergunta 7 -->
                        <div class="p-6">
                            <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ('faq7')">
                                <h3 class="text-lg font-medium text-zinc-900 dark:text-white">
                                    Quais formas de pagamento vocês aceitam?
                                </h3>
                                <svg class="w-5 h-5 text-zinc-500 transform transition-transform" id="faq7-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="mt-4 text-zinc-600 dark:text-zinc-300 hidden" id="faq7-content">
                                <p>Aceitamos as seguintes formas de pagamento:</p>
                                <ul class="list-disc list-inside mt-2 space-y-1">
                                    <li>Cartão de crédito (Visa, Mastercard, Elo)</li>
                                    <li>Cartão de débito</li>
                                    <li>PIX</li>
                                    <li>Boleto bancário</li>
                                    <li>Débito automático</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Pergunta 8 -->
                        <div class="p-6">
                            <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ('faq8')">
                                <h3 class="text-lg font-medium text-zinc-900 dark:text-white">
                                    Como funciona o cancelamento?
                                </h3>
                                <svg class="w-5 h-5 text-zinc-500 transform transition-transform" id="faq8-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="mt-4 text-zinc-600 dark:text-zinc-300 hidden" id="faq8-content">
                                <p>O cancelamento pode ser feito a qualquer momento através do seu painel online ou 
                                entrando em contato conosco. O acesso aos serviços continua até o final do período já pago.</p>
                            </div>
                        </div>

                        <!-- Pergunta 9 -->
                        <div class="p-6">
                            <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ('faq9')">
                                <h3 class="text-lg font-medium text-zinc-900 dark:text-white">
                                    Há taxa de cancelamento?
                                </h3>
                                <svg class="w-5 h-5 text-zinc-500 transform transition-transform" id="faq9-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="mt-4 text-zinc-600 dark:text-zinc-300 hidden" id="faq9-content">
                                <p>Não cobramos taxa de cancelamento. Você pode cancelar seu plano a qualquer momento 
                                sem custos adicionais.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Geral -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm">
                    <h2 class="text-xl font-semibold text-zinc-900 dark:text-white p-6 border-b border-zinc-200 dark:border-zinc-700">
                        ❓ Geral
                    </h2>
                    
                    <div class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        <!-- Pergunta 10 -->
                        <div class="p-6">
                            <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ('faq10')">
                                <h3 class="text-lg font-medium text-zinc-900 dark:text-white">
                                    Preciso de experiência prévia para começar?
                                </h3>
                                <svg class="w-5 h-5 text-zinc-500 transform transition-transform" id="faq10-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="mt-4 text-zinc-600 dark:text-zinc-300 hidden" id="faq10-content">
                                <p>Não! Nossos programas são adaptados para todos os níveis, desde iniciantes até avançados. 
                                Nossos instrutores estão preparados para orientar você desde o primeiro dia.</p>
                            </div>
                        </div>

                        <!-- Pergunta 11 -->
                        <div class="p-6">
                            <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ('faq11')">
                                <h3 class="text-lg font-medium text-zinc-900 dark:text-white">
                                    Vocês oferecem avaliação física?
                                </h3>
                                <svg class="w-5 h-5 text-zinc-500 transform transition-transform" id="faq11-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="mt-4 text-zinc-600 dark:text-zinc-300 hidden" id="faq11-content">
                                <p>Sim! Oferecemos avaliação física completa para todos os membros, incluindo 
                                análise de composição corporal, teste de flexibilidade e orientação personalizada.</p>
                            </div>
                        </div>

                        <!-- Pergunta 12 -->
                        <div class="p-6">
                            <button class="flex justify-between items-center w-full text-left" onclick="toggleFAQ('faq12')">
                                <h3 class="text-lg font-medium text-zinc-900 dark:text-white">
                                    Como posso entrar em contato?
                                </h3>
                                <svg class="w-5 h-5 text-zinc-500 transform transition-transform" id="faq12-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="mt-4 text-zinc-600 dark:text-zinc-300 hidden" id="faq12-content">
                                <p>Você pode nos contatar através de:</p>
                                <ul class="list-disc list-inside mt-2 space-y-1">
                                    <li><strong>WhatsApp:</strong> (11) 99999-9999</li>
                                    <li><strong>E-mail:</strong> contato@fitplanacademy.com</li>
                                    <li><strong>Telefone:</strong> (11) 9999-9999</li>
                                    <li><strong>Presencialmente:</strong> Em qualquer uma de nossas unidades</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Contato -->
            <div class="mt-12 bg-primary rounded-xl p-8 text-center">
                <h2 class="text-2xl font-bold text-white mb-4">
                    Não encontrou sua resposta?
                </h2>
                <p class="text-white/90 mb-6">
                    Nossa equipe está pronta para ajudar você com qualquer dúvida
                </p>
                <a href="<?php echo e(route('contact')); ?>" 
                   class="inline-flex items-center px-6 py-3 bg-white text-primary font-semibold rounded-lg hover:bg-zinc-50 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    Entrar em Contato
                </a>
            </div>

        </div>
    </div>
</div>

<script>
function toggleFAQ(faqId) {
    const content = document.getElementById(faqId + '-content');
    const icon = document.getElementById(faqId + '-icon');
    
    if (content.classList.contains('hidden')) {
        content.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
    } else {
        content.classList.add('hidden');
        icon.style.transform = 'rotate(0deg)';
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/eduardocruz/fitplan_acadamy/resources/views/legal/faq.blade.php ENDPATH**/ ?>