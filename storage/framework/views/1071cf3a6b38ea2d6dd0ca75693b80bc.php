<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>FitPlan Academy - Eleve Seu Fitness</title>
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
        
        /* Animação suave para o submenu */
        .dropdown-menu {
            backdrop-filter: blur(8px);
        }
        
        /* Efeito hover nos itens do submenu */
        .dropdown-item {
            transition: all 0.2s ease;
        }
        
        .dropdown-item:hover {
            transform: translateX(4px);
        }
        
        /* Animação da seta */
        .dropdown-arrow {
            transition: transform 0.3s ease;
        }
        
        /* Sombra personalizada */
        .custom-shadow {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .dark .custom-shadow {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-zinc-900 dark:text-zinc-200">
<div class="min-h-screen">
    <!-- Barra de Acessibilidade -->
    <?php echo $__env->make('components.accessibility-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <!-- Header Completo com Submenus -->
    <?php echo $__env->make('components.header-working', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <main>
        <section id="hero" class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="flex flex-col gap-6">
                    <h1 class="text-4xl md:text-6xl font-black tracking-tighter text-zinc-900 dark:text-white">Eleve Sua Jornada Fitness</h1>
                    <p class="text-lg text-zinc-600 dark:text-zinc-300">Desbloqueie seu potencial com a FitPlan Academy. Experimente treinamento personalizado, aulas diversificadas e uma comunidade de apoio para alcançar seus objetivos de fitness.</p>
                    <a href="<?php echo e(route('cadastro')); ?>" class="self-start px-6 py-3 text-base font-bold text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">Cadastre-se</a>
                </div>
                <div class="w-full aspect-video bg-cover bg-center rounded-xl" style='background-image: url("https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=800");'></div>
            </div>
        </section>

        <section id="planos" class="bg-background-light dark:bg-zinc-900 py-16 md:py-24">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-zinc-900 dark:text-white">Escolha Seu Plano</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="<?php echo e($plan->name === 'Smart' ? 'bg-orange-500 text-white relative overflow-hidden' : 'bg-white dark:bg-background-dark'); ?> border border-zinc-200 dark:border-zinc-800 rounded-xl p-8 flex flex-col">
                        <?php if($plan->name === 'Smart'): ?>
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/20 rounded-full"></div>
                        <div class="absolute bottom-4 left-4 w-16 h-16 bg-white/20 rounded-full"></div>
                        <?php endif; ?>
                        
                        <h3 class="text-xl font-bold <?php echo e($plan->name === 'Smart' ? 'text-white' : 'text-zinc-900 dark:text-white'); ?>"><?php echo e($plan->name); ?></h3>
                        <p class="mt-2 mb-6">
                            <span class="text-5xl font-black <?php echo e($plan->name === 'Smart' ? 'text-white' : 'text-zinc-900 dark:text-white'); ?>">R$ <?php echo e(number_format($plan->price, 0, ',', '.')); ?></span>
                            <span class="<?php echo e($plan->name === 'Smart' ? 'text-white' : 'text-zinc-600 dark:text-zinc-400'); ?>">/mês</span>
                        </p>
                        <form action="<?php echo e(route('checkout', $plan->id)); ?>" method="GET">
                            <button type="submit" class="w-full py-3 font-bold <?php echo e($plan->name === 'Smart' ? 'text-orange-500 bg-white hover:bg-gray-50' : 'text-primary bg-primary/10 dark:bg-primary/20 hover:bg-primary/20 dark:hover:bg-primary/30'); ?> rounded-lg transition-colors">
                                Cadastre-se
                            </button>
                        </form>
                        <ul class="mt-8 space-y-4 text-sm <?php echo e($plan->name === 'Smart' ? 'text-white' : 'text-zinc-600 dark:text-zinc-300'); ?>">
                            <?php $__currentLoopData = $plan->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="flex items-center gap-3">
                                <svg class="<?php echo e($plan->name === 'Smart' ? 'text-white' : 'text-primary'); ?> size-5" fill="currentColor" viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg"><path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path></svg>
                                <?php echo e($feature); ?>

                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>

        <section id="comparacao" class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-zinc-900 dark:text-white">Comparação de Benefícios</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="p-4 bg-zinc-100 dark:bg-zinc-800 rounded-tl-lg font-bold text-zinc-900 dark:text-white">Recurso</th>
                            <th class="p-4 bg-zinc-100 dark:bg-zinc-800 text-center font-bold text-zinc-900 dark:text-white">Basic</th>
                            <th class="p-4 bg-zinc-100 dark:bg-zinc-800 text-center font-bold text-zinc-900 dark:text-white">Smart</th>
                            <th class="p-4 bg-zinc-100 dark:bg-zinc-800 rounded-tr-lg text-center font-bold text-zinc-900 dark:text-white">Black</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-zinc-200 dark:border-zinc-800">
                            <td class="p-4 text-zinc-600 dark:text-zinc-300">Acesso à Academia</td>
                            <td class="p-4 text-center"><span class="inline-block size-5 bg-primary/20 dark:bg-primary/30 rounded-full"></span></td>
                            <td class="p-4 text-center"><span class="inline-block size-5 bg-primary/20 dark:bg-primary/30 rounded-full"></span></td>
                            <td class="p-4 text-center"><span class="inline-block size-5 bg-primary/20 dark:bg-primary/30 rounded-full"></span></td>
                        </tr>
                        <tr class="border-b border-zinc-200 dark:border-zinc-800">
                            <td class="p-4 text-zinc-600 dark:text-zinc-300">Aulas em Grupo</td>
                            <td class="p-4 text-center"><span class="inline-block size-5 bg-primary/20 dark:bg-primary/30 rounded-full"></span></td>
                            <td class="p-4 text-center"><span class="inline-block size-5 bg-primary/20 dark:bg-primary/30 rounded-full"></span></td>
                            <td class="p-4 text-center"><span class="inline-block size-5 bg-primary/20 dark:bg-primary/30 rounded-full"></span></td>
                        </tr>
                        <tr class="border-b border-zinc-200 dark:border-zinc-800">
                            <td class="p-4 text-zinc-600 dark:text-zinc-300">Personal Trainer</td>
                            <td class="p-4 text-center"></td>
                            <td class="p-4 text-center"><span class="inline-block size-5 bg-primary/20 dark:bg-primary/30 rounded-full"></span></td>
                            <td class="p-4 text-center"><span class="inline-block size-5 bg-primary/20 dark:bg-primary/30 rounded-full"></span></td>
                        </tr>
                        <tr class="border-b border-zinc-200 dark:border-zinc-800">
                            <td class="p-4 text-zinc-600 dark:text-zinc-300">Planos Nutricionais</td>
                            <td class="p-4 text-center"></td>
                            <td class="p-4 text-center"><span class="inline-block size-5 bg-primary/20 dark:bg-primary/30 rounded-full"></span></td>
                            <td class="p-4 text-center"><span class="inline-block size-5 bg-primary/20 dark:bg-primary/30 rounded-full"></span></td>
                        </tr>
                        <tr>
                            <td class="p-4 text-zinc-600 dark:text-zinc-300">Instalações Premium</td>
                            <td class="p-4 text-center"></td>
                            <td class="p-4 text-center"></td>
                            <td class="p-4 text-center"><span class="inline-block size-5 bg-primary/20 dark:bg-primary/30 rounded-full"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section id="locais" class="bg-background-light dark:bg-zinc-900 py-16 md:py-24">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-zinc-900 dark:text-white">Nossas Unidades</h2>
                <div class="w-full h-96 bg-cover bg-center rounded-xl mb-12" style='background-image: url("https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=1200");'></div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="flex flex-col gap-4">
                        <div class="w-full aspect-square bg-cover bg-center rounded-lg" style='background-image: url("https://images.unsplash.com/photo-1540497077202-7c8a3999166f?w=400");'></div>
                        <div>
                            <p class="font-bold text-zinc-900 dark:text-white">Centro</p>
                            <p class="text-sm text-zinc-600 dark:text-zinc-400">Av. Paulista, 1000 - São Paulo</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4">
                        <div class="w-full aspect-square bg-cover bg-center rounded-lg" style='background-image: url("https://images.unsplash.com/photo-1571902943202-507ec2618e8f?w=400");'></div>
                        <div>
                            <p class="font-bold text-zinc-900 dark:text-white">Zona Sul</p>
                            <p class="text-sm text-zinc-600 dark:text-zinc-400">Rua Augusta, 500 - São Paulo</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4">
                        <div class="w-full aspect-square bg-cover bg-center rounded-lg" style='background-image: url("https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=400");'></div>
                        <div>
                            <p class="font-bold text-zinc-900 dark:text-white">Zona Oeste</p>
                            <p class="text-sm text-zinc-600 dark:text-zinc-400">Av. Faria Lima, 2000 - São Paulo</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
</body>
</html><?php /**PATH /Users/eduardocruz/fitplan_acadamy/resources/views/landing.blade.php ENDPATH**/ ?>