<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preços e Promoções - FitPlan Academy</title>
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
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-zinc-900 dark:text-zinc-200">
<div class="min-h-screen">
    <!-- Barra de Acessibilidade -->
    <?php echo $__env->make('components.accessibility-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <!-- Header -->
    <?php echo $__env->make('components.header-working', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Main Content -->
    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header da Página -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-zinc-900 dark:text-white mb-4">Tabela de Preços</h1>
            <p class="text-xl text-zinc-600 dark:text-zinc-400 max-w-3xl mx-auto">
                Escolha a modalidade de pagamento que melhor se adapta ao seu orçamento. Quanto mais tempo você se compromete, maior o desconto!
            </p>
        </div>

        <!-- Tabela de Preços -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg overflow-hidden mb-12">
            <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700">
                <h2 class="text-2xl font-bold text-zinc-900 dark:text-white">Nossos Preços</h2>
                <p class="text-zinc-600 dark:text-zinc-400 mt-2">Compare os valores mensais, trimestrais e anuais</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-zinc-50 dark:bg-zinc-700">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-zinc-900 dark:text-white">Plano</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-zinc-900 dark:text-white">Mensal</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-zinc-900 dark:text-white">Trimestral</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-zinc-900 dark:text-white">Anual</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-zinc-900 dark:text-white">Economia</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-3 h-3 rounded-full bg-primary"></div>
                                    <div>
                                        <div class="text-sm font-medium text-zinc-900 dark:text-white"><?php echo e($plan['name']); ?></div>
                                        <div class="text-sm text-zinc-500 dark:text-zinc-400"><?php echo e($plan['description']); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="text-lg font-bold text-zinc-900 dark:text-white">
                                    R$ <?php echo e(number_format($pricing['monthly'][$plan['id']], 2, ',', '.')); ?>

                                </div>
                                <div class="text-sm text-zinc-500 dark:text-zinc-400">por mês</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="text-lg font-bold text-zinc-900 dark:text-white">
                                    R$ <?php echo e(number_format($pricing['quarterly'][$plan['id']], 2, ',', '.')); ?>

                                </div>
                                <div class="text-sm text-zinc-500 dark:text-zinc-400">3 meses</div>
                                <div class="text-xs text-green-600 dark:text-green-400 font-medium">
                                    Economia: R$ <?php echo e(number_format(($pricing['monthly'][$plan['id']] * 3) - $pricing['quarterly'][$plan['id']], 2, ',', '.')); ?>

                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="text-lg font-bold text-zinc-900 dark:text-white">
                                    R$ <?php echo e(number_format($pricing['annual'][$plan['id']], 2, ',', '.')); ?>

                                </div>
                                <div class="text-sm text-zinc-500 dark:text-zinc-400">12 meses</div>
                                <div class="text-xs text-green-600 dark:text-green-400 font-medium">
                                    Economia: R$ <?php echo e(number_format(($pricing['monthly'][$plan['id']] * 12) - $pricing['annual'][$plan['id']], 2, ',', '.')); ?>

                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="text-sm font-medium text-zinc-900 dark:text-white">
                                    Até <?php echo e(number_format((($pricing['monthly'][$plan['id']] * 12) - $pricing['annual'][$plan['id']]) / ($pricing['monthly'][$plan['id']] * 12) * 100, 0)); ?>%
                                </div>
                                <div class="text-xs text-zinc-500 dark:text-zinc-400">no plano anual</div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Promoções -->
        <div class="mb-12">
            <h2 class="text-3xl font-bold text-zinc-900 dark:text-white text-center mb-8">Promoções Especiais</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php $__currentLoopData = $pricing['promotions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promotion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-gradient-to-r from-primary/10 to-primary/5 dark:from-primary/20 dark:to-primary/10 rounded-xl p-6 border border-primary/20">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-zinc-900 dark:text-white"><?php echo e($promotion['title']); ?></h3>
                            <p class="text-zinc-600 dark:text-zinc-400 mt-2"><?php echo e($promotion['description']); ?></p>
                        </div>
                        <div class="bg-primary text-white px-3 py-1 rounded-full text-sm font-semibold">
                            -R$ <?php echo e(number_format($promotion['discount'], 2, ',', '.')); ?>

                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-zinc-500 dark:text-zinc-400">
                            Válido até: <?php echo e($promotion['valid_until']); ?>

                        </div>
                        <button class="bg-primary hover:bg-primary/90 text-white font-semibold py-2 px-4 rounded-lg transition-colors text-sm">
                            Aproveitar Oferta
                        </button>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Formas de Pagamento -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-8 mb-12">
            <h2 class="text-2xl font-bold text-zinc-900 dark:text-white mb-6">Formas de Pagamento</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Cartões de Crédito</h3>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-8 bg-blue-600 rounded flex items-center justify-center">
                            <span class="text-white text-xs font-bold">VISA</span>
                        </div>
                        <div class="w-12 h-8 bg-red-600 rounded flex items-center justify-center">
                            <span class="text-white text-xs font-bold">MC</span>
                        </div>
                        <div class="w-12 h-8 bg-blue-500 rounded flex items-center justify-center">
                            <span class="text-white text-xs font-bold">AMEX</span>
                        </div>
                        <div class="w-12 h-8 bg-green-600 rounded flex items-center justify-center">
                            <span class="text-white text-xs font-bold">ELO</span>
                        </div>
                    </div>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400">
                        Aceitamos todos os cartões de crédito em até 12x sem juros.
                    </p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Outras Formas</h3>
                    <div class="space-y-2">
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 rounded-full bg-green-500"></div>
                            <span class="text-sm text-zinc-600 dark:text-zinc-400">PIX (5% de desconto)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 rounded-full bg-green-500"></div>
                            <span class="text-sm text-zinc-600 dark:text-zinc-400">Boleto Bancário</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 rounded-full bg-green-500"></div>
                            <span class="text-sm text-zinc-600 dark:text-zinc-400">Débito Automático</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ de Preços -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-zinc-900 dark:text-white mb-6">Perguntas Frequentes sobre Preços</h2>
            
            <div class="space-y-6">
                <div class="border-b border-zinc-200 dark:border-zinc-700 pb-4">
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">
                        Posso cancelar a qualquer momento?
                    </h3>
                    <p class="text-zinc-600 dark:text-zinc-400">
                        Sim! Você pode cancelar sua assinatura a qualquer momento sem multas ou taxas adicionais.
                    </p>
                </div>
                
                <div class="border-b border-zinc-200 dark:border-zinc-700 pb-4">
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">
                        Há taxa de matrícula?
                    </h3>
                    <p class="text-zinc-600 dark:text-zinc-400">
                        Não cobramos taxa de matrícula. Você paga apenas a mensalidade do plano escolhido.
                    </p>
                </div>
                
                <div class="border-b border-zinc-200 dark:border-zinc-700 pb-4">
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">
                        Os preços podem mudar?
                    </h3>
                    <p class="text-zinc-600 dark:text-zinc-400">
                        Os preços são fixos durante o período contratado. Qualquer alteração será comunicada com antecedência.
                    </p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">
                        Posso trocar de plano?
                    </h3>
                    <p class="text-zinc-600 dark:text-zinc-400">
                        Sim! Você pode fazer upgrade ou downgrade do seu plano a qualquer momento, com ajuste proporcional na cobrança.
                    </p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="mt-12 text-center">
            <div class="bg-primary/10 dark:bg-primary/20 rounded-xl p-8">
                <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-4">
                    Encontrou o plano ideal?
                </h3>
                <p class="text-zinc-600 dark:text-zinc-400 mb-6 max-w-2xl mx-auto">
                    Comece sua jornada fitness hoje mesmo e transforme sua vida com a FitPlan Academy.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="<?php echo e(route('register')); ?>" class="bg-primary hover:bg-primary/90 text-white font-semibold py-3 px-8 rounded-lg transition-colors">
                        Começar Agora
                    </a>
                    <a href="<?php echo e(route('cadastro')); ?>" class="bg-white dark:bg-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-700 text-zinc-900 dark:text-white font-semibold py-3 px-8 rounded-lg transition-colors border border-zinc-300 dark:border-zinc-600">
                        Falar com Consultor
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
<?php /**PATH /Users/eduardocruz/fitplan_acadamy/resources/views/comparison/prices.blade.php ENDPATH**/ ?>