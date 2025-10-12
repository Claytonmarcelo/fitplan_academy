<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>FitPlan Academy - Eleve Seu Fitness</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">FitPlan Academy</h1>
        <p class="text-gray-600 mb-8">Landing page completa funcionando</p>
        
        <div class="grid md:grid-cols-3 gap-6">
            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white rounded-lg shadow-sm p-6 <?php echo e($plan->name === 'Smart' ? 'ring-2 ring-orange-500' : ''); ?>">
                <?php if($plan->name === 'Smart'): ?>
                    <div class="text-center mb-4">
                        <span class="inline-block px-4 py-2 text-sm font-bold text-white bg-orange-500 rounded-full">MAIS POPULAR</span>
                    </div>
                <?php endif; ?>
                
                <h3 class="text-xl font-semibold text-gray-900 mb-2"><?php echo e($plan->name); ?></h3>
                <p class="text-gray-600 mb-4">R$ <?php echo e(number_format($plan->price, 2, ',', '.')); ?>/mês</p>
                <p class="text-gray-500 text-sm mb-4"><?php echo e($plan->description); ?></p>
                
                <ul class="space-y-2 mb-4">
                    <?php $__currentLoopData = $plan->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm text-gray-600"><?php echo e($feature); ?></span>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                
                <a href="<?php echo e(route('plan.' . strtolower($plan->name))); ?>" class="block w-full text-center px-4 py-2 bg-orange-500 text-white rounded-lg">Escolher <?php echo e($plan->name); ?></a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <div class="mt-8 text-center">
            <a href="<?php echo e(route('cadastro')); ?>" class="inline-block px-6 py-3 bg-orange-500 text-white rounded-lg">Cadastre-se</a>
        </div>
    </div>
</body>
</html><?php /**PATH /Users/eduardocruz/fitplan_acadamy/resources/views/landing.blade.php ENDPATH**/ ?>