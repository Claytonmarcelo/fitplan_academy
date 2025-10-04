<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Plano <?php echo e($currentPlan->name); ?> - FitPlan Academy</title>
    <link href="<?php echo e(asset('favicon.ico')); ?>" rel="icon" type="image/x-icon"/>
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
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-sm border-b border-zinc-200 dark:border-zinc-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-4">
                    <a href="<?php echo e(route('landing')); ?>" class="flex items-center gap-4">
                        <div class="text-primary size-8">
                            <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                <path d="M42.1739 20.1739L27.8261 5.82609C29.1366 7.13663 28.3989 10.1876 26.2002 13.7654C24.8538 15.9564 22.9595 18.3449 20.6522 20.6522C18.3449 22.9595 15.9564 24.8538 13.7654 26.2002C10.1876 28.3989 7.13663 29.1366 5.82609 27.8261L20.1739 42.1739C21.4845 43.4845 24.5355 42.7467 28.1133 40.548C30.3042 39.2016 32.6927 37.3073 35 35C37.3073 32.6927 39.2016 30.3042 40.548 28.1133C42.7467 24.5355 43.4845 21.4845 42.1739 20.1739Z" fill="currentColor"></path>
                                <path clip-rule="evenodd" d="M7.24189 26.4066C7.31369 26.4411 7.64204 26.5637 8.52504 26.3738C9.59462 26.1438 11.0343 25.5311 12.7183 24.4963C14.7583 23.2426 17.0256 21.4503 19.238 19.238C21.4503 17.0256 23.2426 14.7583 24.4963 12.7183C25.5311 11.0343 26.1438 9.59463 26.3738 8.52504C26.5637 7.64204 26.4411 7.31369 26.4066 7.24189C26.345 7.21246 26.143 7.14535 25.6664 7.1918C24.9745 7.25925 23.9954 7.5498 22.7699 8.14278C20.3369 9.32007 17.3369 11.4915 14.4142 14.4142C11.4915 17.3369 9.32007 20.3369 8.14278 22.7699C7.5498 23.9954 7.25925 24.9745 7.1918 25.6664C7.14534 26.143 7.21246 26.345 7.24189 26.4066ZM29.9001 10.7285C29.4519 12.0322 28.7617 13.4172 27.9042 14.8126C26.465 17.1544 24.4686 19.6641 22.0664 22.0664C19.6641 24.4686 17.1544 26.465 14.8126 27.9042C13.4172 28.7617 12.0322 29.4519 10.7285 29.9001L21.5754 40.747C21.6001 40.7606 21.8995 40.931 22.8729 40.7217C23.9424 40.4916 25.3821 39.879 27.0661 38.8441C29.1062 37.5904 31.3734 35.7982 33.5858 33.5858C35.7982 31.3734 37.5904 29.1062 38.8441 27.0661C39.879 25.3821 40.4916 23.9425 40.7216 22.8729C40.931 21.8995 40.7606 21.6001 40.747 21.5754L29.9001 10.7285ZM29.2403 4.41187L43.5881 18.7597C44.9757 20.1473 44.9743 22.1235 44.6322 23.7139C44.2714 25.3919 43.4158 27.2666 42.252 29.1604C40.8128 31.5022 38.8165 34.012 36.4142 36.4142C34.012 38.8165 31.5022 40.8128 29.1604 42.252C27.2666 43.4158 25.3919 44.2714 23.7139 44.6322C22.1235 44.9743 20.1473 44.9757 18.7597 43.5881L4.41187 29.2403C3.29027 28.1187 3.08209 26.5973 3.21067 25.2783C3.34099 23.9415 3.8369 22.4852 4.54214 21.0277C5.96129 18.0948 8.43335 14.7382 11.5858 11.5858C14.7382 8.43335 18.0948 5.9613 21.0277 4.54214C22.4852 3.8369 23.9415 3.34099 25.2783 3.21067C26.5973 3.08209 28.1187 3.29028 29.2403 4.41187Z" fill="currentColor" fill-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">FitPlan Academy</h1>
                    </a>
                </div>
                <div class="flex items-center gap-2">
                    <a href="<?php echo e(route('landing')); ?>" class="px-4 py-2 text-sm font-medium text-zinc-600 dark:text-zinc-300 hover:text-primary transition-colors">← Voltar</a>
                    <a href="<?php echo e(route('cadastro')); ?>" class="px-4 py-2 text-sm font-bold text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">Cadastre-se</a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <!-- Hero Section do Plano -->
        <section class="py-16 md:py-24 <?php echo e($currentPlan->name === 'Smart' ? 'bg-orange-500' : 'bg-white dark:bg-zinc-800'); ?> <?php echo e($currentPlan->name === 'Smart' ? 'text-white' : ''); ?>">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="flex flex-col gap-6">
                        <?php if($currentPlan->name === 'Smart'): ?>
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/20 rounded-full text-sm font-medium mb-2">
                            <span class="w-2 h-2 bg-white rounded-full"></span>
                            Plano Mais Popular
                        </div>
                        <?php endif; ?>
                        
                        <h1 class="text-4xl md:text-6xl font-black tracking-tight <?php echo e($currentPlan->name === 'Smart' ? 'text-white' : 'text-zinc-900 dark:text-white'); ?>">
                            Plano <?php echo e($currentPlan->name); ?>

                        </h1>
                        <p class="text-lg <?php echo e($currentPlan->name === 'Smart' ? 'text-white/90' : 'text-zinc-600 dark:text-zinc-300'); ?>">
                            <?php echo e($currentPlan->description); ?>

                        </p>
                        
                        <div class="flex items-baseline gap-2 mb-6">
                            <span class="text-6xl font-black <?php echo e($currentPlan->name === 'Smart' ? 'text-white' : 'text-zinc-900 dark:text-white'); ?>">
                                R$ <?php echo e(number_format($currentPlan->price, 2, ',', '.')); ?>

                            </span>
                            <span class="<?php echo e($currentPlan->name === 'Smart' ? 'text-white/70' : 'text-zinc-600 dark:text-zinc-400'); ?>">/mês</span>
                        </div>
                        
                        <div class="flex gap-4">
                            <a href="<?php echo e(route('cadastro')); ?>" class="px-8 py-4 text-lg font-bold <?php echo e($currentPlan->name === 'Smart' ? 'text-orange-500 bg-white hover:bg-gray-50' : 'text-white bg-primary hover:bg-primary/90'); ?> rounded-lg transition-colors inline-block text-center">
                                Cadastre-se
                            </a>
                            <?php if($currentPlan->name === 'Basic'): ?>
                            <a href="<?php echo e(route('plan.smart')); ?>" class="px-8 py-4 text-lg font-bold text-zinc-600 dark:text-zinc-300 border border-zinc-200 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-700 rounded-lg transition-colors">
                                Ver Smart →
                            </a>
                            <?php elseif($currentPlan->name === 'Smart'): ?>
                            <a href="<?php echo e(route('plan.black')); ?>" class="px-8 py-4 text-lg font-bold text-white border border-white/30 hover:bg-white/10 rounded-lg transition-colors">
                                Ver Black →
                            </a>
                            <?php elseif($currentPlan->name === 'Black'): ?>
                            <a href="<?php echo e(route('plan.smart')); ?>" class="px-8 py-4 text-lg font-bold text-zinc-600 dark:text-zinc-300 border border-zinc-200 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-700 rounded-lg transition-colors">
                                Comparar com Smart ←
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <div class="w-full aspect-video bg-cover bg-center rounded-xl bg-gradient-to-r from-zinc-100 to-zinc-200 dark:from-zinc-700 dark:to-zinc-800 flex items-center justify-center">
                            <?php if($currentPlan->name === 'Basic'): ?>
                            <div class="text-center">
                                <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mb-4 mx-auto">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Poder Básico</h3>
                                <p class="text-zinc-600 dark:text-zinc-400">Todos os equipamentos essenciais</p>
                            </div>
                            <?php elseif($currentPlan->name === 'Smart'): ?>
                            <div class="text-center text-white">
                                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mb-4 mx-auto">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-white">Super Inteligente</h3>
                                <p class="text-white/80">Tecnologia + Comunidade</p>
                            </div>
                            <?php else: ?>
                            <div class="text-center">
                                <div class="w-16 h-16 bg-zinc-900 dark:bg-white rounded-full flex items-center justify-center mb-4 mx-auto">
                                    <svg class="w-8 h-8 text-white dark:text-zinc-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Ultra Premium</h3>
                                <p class="text-zinc-600 dark:text-zinc-400">Experiência completa VIP</p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Benefícios Detalhados -->
        <section class="py-16 md:py-24 bg-white dark:bg-zinc-900">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 gap-16">
                    <!-- O que você recebe -->
                    <div>
                        <h2 class="text-3xl font-bold text-zinc-900 dark:text-white mb-8">O que você recebe</h2>
                        <ul class="space-y-4">
                            <?php $__currentLoopData = $currentPlan->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="flex items-start gap-3">
                                <div class="w-6 h-6 bg-primary flex-shrink-0 rounded-full flex items-center justify-center mt-0.5">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-zinc-700 dark:text-zinc-300"><?php echo e($feature); ?></span>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    
                    <!-- Benefícios exclusivos -->
                    <div>
                        <h2 class="text-3xl font-bold text-zinc-900 dark:text-white mb-8">Benefícios exclusivos</h2>
                        <ul class="space-y-4">
                            <?php $__currentLoopData = $currentPlan->benefits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="flex items-start gap-3">
                                <div class="w-6 h-6 bg-orange-500 flex-shrink-0 rounded-full flex items-center justify-center mt-0.5">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                </div>
                                <span class="text-zinc-700 dark:text-zinc-300"><?php echo e($benefit); ?></span>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Outros Planos -->
        <section class="py-16 md:py-24 bg-zinc-50 dark:bg-zinc-800">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-zinc-900 dark:text-white">Outros Planos</h2>
                <div class="grid md:grid-cols-2 gap-8">
                    <?php $__currentLoopData = $plans->where('name', '!=', $currentPlan->name); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $otherPlan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-xl p-8 flex flex-col">
                        <h3 class="text-xl font-bold text-zinc-900 dark:text-white mb-2"><?php echo e($otherPlan->name); ?></h3>
                        <p class="text-zinc-600 dark:text-zinc-400 mb-4"><?php echo e($otherPlan->description); ?></p>
                        <div class="flex items-baseline gap-2 mb-6">
                            <span class="text-3xl font-bold text-primary">R$ <?php echo e(number_format($otherPlan->price, 2, ',', '.')); ?></span>
                            <span class="text-zinc-600 dark:text-zinc-400">/mês</span>
                        </div>
                        <a href="<?php echo e(route('plan.' . strtolower($otherPlan->name))); ?>" class="w-full py-3 font-bold text-primary border border-primary hover:bg-primary/10 dark:hover:bg-primary/20 rounded-lg transition-colors text-center">
                            Ver Detalhes
                        </a>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-zinc-900 dark:bg-black py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center text-zinc-400">
            <p>&copy; 2024 FitPlan Academy. Todos os direitos reservados.</p>
        </div>
    </footer>
</div>
</body>
</html>
<?php /**PATH /Users/eduardocruz/fitplan_acadamy/resources/views/plans/show.blade.php ENDPATH**/ ?>