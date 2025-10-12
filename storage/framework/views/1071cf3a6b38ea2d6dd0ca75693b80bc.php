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
        <p class="text-gray-600 mb-8">Página de teste da landing page</p>
        
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Basic</h3>
                <p class="text-gray-600">R$ 79,90/mês</p>
                <a href="<?php echo e(route('plan.basic')); ?>" class="block w-full text-center px-4 py-2 bg-orange-500 text-white rounded-lg mt-4">Escolher Basic</a>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm p-6 ring-2 ring-orange-500">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Smart</h3>
                <p class="text-gray-600">R$ 129,90/mês</p>
                <a href="<?php echo e(route('plan.smart')); ?>" class="block w-full text-center px-4 py-2 bg-orange-500 text-white rounded-lg mt-4">Escolher Smart</a>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Black</h3>
                <p class="text-gray-600">R$ 199,90/mês</p>
                <a href="<?php echo e(route('plan.black')); ?>" class="block w-full text-center px-4 py-2 bg-orange-500 text-white rounded-lg mt-4">Escolher Black</a>
            </div>
        </div>
        
        <div class="mt-8 text-center">
            <a href="<?php echo e(route('cadastro')); ?>" class="inline-block px-6 py-3 bg-orange-500 text-white rounded-lg">Cadastre-se</a>
        </div>
    </div>
</body>
</html><?php /**PATH /Users/eduardocruz/fitplan_acadamy/resources/views/landing.blade.php ENDPATH**/ ?>