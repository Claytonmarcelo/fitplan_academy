<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comparação Completa - FitPlan Academy</title>
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
            <h1 class="text-4xl font-bold text-zinc-900 dark:text-white mb-4">Comparação Completa</h1>
            <p class="text-xl text-zinc-600 dark:text-zinc-400 max-w-3xl mx-auto">
                Compare todos os nossos planos e escolha o que melhor se adapta ao seu estilo de vida e objetivos fitness.
            </p>
        </div>

        <!-- Cards dos Planos -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="relative bg-white dark:bg-zinc-800 rounded-xl shadow-lg p-8 <?php echo e($plan['popular'] ? 'ring-2 ring-primary' : ''); ?>">
                <?php if($plan['popular']): ?>
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                    <span class="bg-primary text-white px-4 py-2 rounded-full text-sm font-semibold">
                        Mais Popular
                    </span>
                </div>
                <?php endif; ?>
                
                <div class="text-center mb-6">
                    <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-2"><?php echo e($plan['name']); ?></h3>
                    <p class="text-zinc-600 dark:text-zinc-400 mb-4"><?php echo e($plan['description']); ?></p>
                    <div class="text-4xl font-bold text-primary mb-2">
                        R$ <?php echo e(number_format($plan['price'], 2, ',', '.')); ?>

                    </div>
                    <div class="text-sm text-zinc-500 dark:text-zinc-400">por mês</div>
                </div>

                <div class="space-y-4 mb-8">
                    <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-5 h-5 rounded-full flex items-center justify-center <?php echo e($feature[$plan['id']] ? 'bg-green-500' : 'bg-zinc-300 dark:bg-zinc-600'); ?>">
                                <?php if($feature[$plan['id']]): ?>
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <?php endif; ?>
                            </div>
                            <span class="text-sm font-medium text-zinc-900 dark:text-white"><?php echo e($feature['name']); ?></span>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <button class="w-full bg-primary hover:bg-primary/90 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                    Escolher <?php echo e($plan['name']); ?>

                </button>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- Tabela de Comparação Detalhada -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700">
                <h2 class="text-2xl font-bold text-zinc-900 dark:text-white">Comparação Detalhada</h2>
                <p class="text-zinc-600 dark:text-zinc-400 mt-2">Veja todos os recursos e funcionalidades de cada plano</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-zinc-50 dark:bg-zinc-700">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-zinc-900 dark:text-white">Recurso</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-zinc-900 dark:text-white">Basic</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-zinc-900 dark:text-white">Smart</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-zinc-900 dark:text-white">Black</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50">
                            <td class="px-6 py-4">
                                <div>
                                    <div class="text-sm font-medium text-zinc-900 dark:text-white"><?php echo e($feature['name']); ?></div>
                                    <div class="text-sm text-zinc-500 dark:text-zinc-400"><?php echo e($feature['description']); ?></div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <?php if($feature['basic']): ?>
                                <div class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-green-500 text-white">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <?php else: ?>
                                <div class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-zinc-300 dark:bg-zinc-600 text-zinc-500 dark:text-zinc-400">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <?php if($feature['smart']): ?>
                                <div class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-green-500 text-white">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <?php else: ?>
                                <div class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-zinc-300 dark:bg-zinc-600 text-zinc-500 dark:text-zinc-400">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <?php if($feature['black']): ?>
                                <div class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-green-500 text-white">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <?php else: ?>
                                <div class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-zinc-300 dark:bg-zinc-600 text-zinc-500 dark:text-zinc-400">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="mt-12 text-center">
            <div class="bg-primary/10 dark:bg-primary/20 rounded-xl p-8">
                <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-4">
                    Pronto para começar sua jornada fitness?
                </h3>
                <p class="text-zinc-600 dark:text-zinc-400 mb-6 max-w-2xl mx-auto">
                    Escolha o plano que melhor se adapta aos seus objetivos e comece hoje mesmo a transformar sua vida.
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
<?php /**PATH /Users/eduardocruz/fitplan_acadamy/resources/views/comparison/index.blade.php ENDPATH**/ ?>