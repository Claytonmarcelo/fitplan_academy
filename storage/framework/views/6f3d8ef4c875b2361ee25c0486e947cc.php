<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidade - FitPlan Academy</title>
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
    <?php echo $__env->make('components.accessibility-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <!-- Header Completo com Submenus -->
    <?php echo $__env->make('components.header-working', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <main class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Política de Privacidade</h1>
        
        <div class="bg-white p-8 rounded-lg shadow">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">1. Informações que Coletamos</h2>
            <p class="text-gray-600 mb-6">Coletamos informações pessoais que você nos fornece diretamente, como nome, email, telefone e dados de pagamento.</p>
            
            <h2 class="text-xl font-semibold text-gray-900 mb-4">2. Como Usamos suas Informações</h2>
            <p class="text-gray-600 mb-6">Utilizamos suas informações para fornecer nossos serviços, processar pagamentos e melhorar sua experiência.</p>
            
            <h2 class="text-xl font-semibold text-gray-900 mb-4">3. Compartilhamento de Informações</h2>
            <p class="text-gray-600 mb-6">Não vendemos ou compartilhamos suas informações pessoais com terceiros sem seu consentimento.</p>
            
            <h2 class="text-xl font-semibold text-gray-900 mb-4">4. Segurança</h2>
            <p class="text-gray-600 mb-6">Implementamos medidas de segurança adequadas para proteger suas informações pessoais.</p>
        </div>
    </main>

    <!-- Rodapé Completo -->
    <?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
</body>
</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/fitplan_acadamy/resources/views/legal/privacy-policy.blade.php ENDPATH**/ ?>