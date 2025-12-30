<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário - FitPlan Academy</title>
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
    <?php echo $__env->make('components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Main Content -->
    <main class="py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Header Section -->
                <div class="mb-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white mb-2">
                                Editar Usuário: <?php echo e($user->name); ?>

                            </h1>
                            <p class="text-zinc-600 dark:text-zinc-400">
                                Atualize as informações do usuário.
                            </p>
                        </div>
                        <a href="<?php echo e(route('users.index')); ?>" class="px-4 py-2 bg-zinc-200 dark:bg-zinc-700 text-zinc-700 dark:text-zinc-300 rounded-lg hover:bg-zinc-300 dark:hover:bg-zinc-600 transition-colors">
                            ← Voltar
                        </a>
                    </div>
                </div>

                <?php if($errors->any()): ?>
                    <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <div>
                                <h3 class="text-sm font-medium text-red-800 dark:text-red-200">Corrija os seguintes erros:</h3>
                                <ul class="mt-2 text-sm text-red-700 dark:text-red-300">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>• <?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Form -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                    <form method="POST" action="<?php echo e(route('users.update', $user)); ?>" class="p-8 space-y-6">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        <!-- Dados Pessoais -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white border-b border-zinc-200 dark:border-zinc-700 pb-2">Dados Pessoais</h3>
                            
                            <div>
                                <label for="name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Nome Completo *</label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="<?php echo e(old('name', $user->name)); ?>"
                                       required
                                       class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">E-mail *</label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       value="<?php echo e(old('email', $user->email)); ?>"
                                       required
                                       class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Telefone *</label>
                                <input type="tel" 
                                       id="phone" 
                                       name="phone" 
                                       value="<?php echo e(old('phone', $user->phone)); ?>"
                                       placeholder="(11) 99999-9999"
                                       required
                                       class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                        </div>

                        <!-- Endereço -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white border-b border-zinc-200 dark:border-zinc-700 pb-2">Endereço</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="cep" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">CEP *</label>
                                    <input type="text" 
                                           id="cep" 
                                           name="cep" 
                                           value="<?php echo e(old('cep', $user->cep)); ?>"
                                           placeholder="00000-000"
                                           required
                                           class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary">
                                </div>
                                <div>
                                    <label for="street" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Logradouro *</label>
                                    <input type="text" 
                                           id="street" 
                                           name="street" 
                                           value="<?php echo e(old('street', $user->street)); ?>"
                                           required
                                           class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="number" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Número *</label>
                                    <input type="text" 
                                           id="number" 
                                           name="number" 
                                           value="<?php echo e(old('number', $user->number)); ?>"
                                           required
                                           class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary">
                                </div>
                                <div>
                                    <label for="complement" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Complemento</label>
                                    <input type="text" 
                                           id="complement" 
                                           name="complement" 
                                           value="<?php echo e(old('complement', $user->complement)); ?>"
                                           class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary">
                                </div>
                            </div>

                            <div>
                                <label for="district" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Bairro *</label>
                                <input type="text" 
                                       id="district" 
                                       name="district" 
                                       value="<?php echo e(old('district', $user->district)); ?>"
                                       required
                                       class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="city" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Cidade *</label>
                                    <input type="text" 
                                           id="city" 
                                           name="city" 
                                           value="<?php echo e(old('city', $user->city)); ?>"
                                           required
                                           class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary">
                                </div>
                                <div>
                                    <label for="state" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Estado *</label>
                                    <input type="text" 
                                           id="state" 
                                           name="state" 
                                           value="<?php echo e(old('state', $user->state)); ?>"
                                           placeholder="SP"
                                           maxlength="2"
                                           required
                                           class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary">
                                </div>
                            </div>
                        </div>

                        <!-- Permissões (apenas para Master) -->
                        <?php if(Auth::user()->isMaster()): ?>
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white border-b border-zinc-200 dark:border-zinc-700 pb-2">Permissões</h3>
                            
                            <div>
                                <label for="role" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Tipo de Usuário *</label>
                                <select id="role" 
                                        name="role" 
                                        required
                                        class="w-full px-4 py-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary">
                                    <option value="common" <?php echo e(old('role', $user->role) === 'common' ? 'selected' : ''); ?>>Usuário Comum</option>
                                    <option value="master" <?php echo e(old('role', $user->role) === 'master' ? 'selected' : ''); ?>>Administrador</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Status do Usuário *</label>
                                <div class="flex items-center gap-4">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" 
                                               name="is_active" 
                                               value="1"
                                               <?php echo e(old('is_active', $user->is_active) ? 'checked' : ''); ?>

                                               required
                                               class="w-4 h-4 text-primary focus:ring-primary">
                                        <span class="text-zinc-700 dark:text-zinc-300">Ativo</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" 
                                               name="is_active" 
                                               value="0"
                                               <?php echo e(!old('is_active', $user->is_active) ? 'checked' : ''); ?>

                                               required
                                               class="w-4 h-4 text-primary focus:ring-primary">
                                        <span class="text-zinc-700 dark:text-zinc-300">Inativo</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Submit Button -->
                        <div class="flex items-center gap-3 pt-6">
                            <button type="submit" class="flex-1 px-4 py-3 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors font-semibold">
                                💾 Salvar Alterações
                            </button>
                            <a href="<?php echo e(route('users.index')); ?>" class="px-4 py-3 bg-zinc-200 dark:bg-zinc-700 text-zinc-700 dark:text-zinc-300 rounded-lg hover:bg-zinc-300 dark:hover:bg-zinc-600 transition-colors">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>



<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/fitplan_acadamy/resources/views/users/edit.blade.php ENDPATH**/ ?>