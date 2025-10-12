<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FitPlan Academy')</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#f97316',
                        'primary-dark': '#ea580c',
                        'background-light': '#fafafa',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-background-light dark:bg-zinc-900">
    <!-- Barra de Acessibilidade -->
    @include('components.accessibility-bar')
    
    <!-- Header -->
    @include('components.header-working')
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('components.footer')
    
    <!-- Accessibility Scripts -->
    <script>
        // Font size adjustment
        function increaseFontSize() {
            document.body.style.fontSize = (parseFloat(getComputedStyle(document.body).fontSize) + 2) + 'px';
        }
        
        function decreaseFontSize() {
            document.body.style.fontSize = (parseFloat(getComputedStyle(document.body).fontSize) - 2) + 'px';
        }
        
        // Dark mode toggle
        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));
        }
        
        // Initialize dark mode from localStorage
        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark');
        }
    </script>
</body>
</html>
