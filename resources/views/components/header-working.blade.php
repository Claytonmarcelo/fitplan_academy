<!-- Header com Submenus Funcionais -->
<style>
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
<header class="sticky top-0 z-40 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-sm border-b border-zinc-200 dark:border-zinc-800">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center gap-4">
                <div class="text-primary size-8">
                    <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <path d="M42.1739 20.1739L27.8261 5.82609C29.1366 7.13663 28.3989 10.1876 26.2002 13.7654C24.8538 15.9564 22.9595 18.3449 20.6522 20.6522C18.3449 22.9595 15.9564 24.8538 13.7654 26.2002C10.1876 28.3989 7.13663 29.1366 5.82609 27.8261L20.1739 42.1739C21.4845 43.4845 24.5355 42.7467 28.1133 40.548C30.3042 39.2016 32.6927 37.3073 35 35C37.3073 32.6927 39.2016 30.3042 40.548 28.1133C42.7467 24.5355 43.4845 21.4845 42.1739 20.1739Z" fill="currentColor"></path>
                        <path clip-rule="evenodd" d="M7.24189 26.4066C7.31369 26.4411 7.64204 26.5637 8.52504 26.3738C9.59462 26.1438 11.0343 25.5311 12.7183 24.4963C14.7583 23.2426 17.0256 21.4503 19.238 19.238C21.4503 17.0256 23.2426 14.7583 24.4963 12.7183C25.5311 11.0343 26.1438 9.59463 26.3738 8.52504C26.5637 7.64204 26.4411 7.31369 26.4066 7.24189C26.345 7.21246 26.143 7.14535 25.6664 7.1918C24.9745 7.25925 23.9954 7.5498 22.7699 8.14278C20.3369 9.32007 17.3369 11.4915 14.4142 14.4142C11.4915 17.3369 9.32007 20.3369 8.14278 22.7699C7.5498 23.9954 7.25925 24.9745 7.1918 25.6664C7.14534 26.143 7.21246 26.345 7.24189 26.4066ZM29.9001 10.7285C29.4519 12.0322 28.7617 13.4172 27.9042 14.8126C26.465 17.1544 24.4686 19.6641 22.0664 22.0664C19.6641 24.4686 17.1544 26.465 14.8126 27.9042C13.4172 28.7617 12.0322 29.4519 10.7285 29.9001L21.5754 40.747C21.6001 40.7606 21.8995 40.931 22.8729 40.7217C23.9424 40.4916 25.3821 39.879 27.0661 38.8441C29.1062 37.5904 31.3734 35.7982 33.5858 33.5858C35.7982 31.3734 37.5904 29.1062 38.8441 27.0661C39.879 25.3821 40.4916 23.9425 40.7216 22.8729C40.931 21.8995 40.7606 21.6001 40.747 21.5754L29.9001 10.7285ZM29.2403 4.41187L43.5881 18.7597C44.9757 20.1473 44.9743 22.1235 44.6322 23.7139C44.2714 25.3919 43.4158 27.2666 42.252 29.1604C40.8128 31.5022 38.8165 34.012 36.4142 36.4142C34.012 38.8165 31.5022 40.8128 29.1604 42.252C27.2666 43.4158 25.3919 44.2714 23.7139 44.6322C22.1235 44.9743 20.1473 44.9757 18.7597 43.5881L4.41187 29.2403C3.29027 28.1187 3.08209 26.5973 3.21067 25.2783C3.34099 23.9415 3.8369 22.4852 4.54214 21.0277C5.96129 18.0948 8.43335 14.7382 11.5858 11.5858C14.7382 8.43335 18.0948 5.9613 21.0277 4.54214C22.4852 3.8369 23.9415 3.34099 25.2783 3.21067C26.5973 3.08209 28.1187 3.29028 29.2403 4.41187Z" fill="currentColor" fill-rule="evenodd"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">FitPlan Academy</h1>
            </div>
            <nav class="hidden md:flex items-center gap-8">
                <a class="text-sm font-medium text-zinc-600 dark:text-zinc-300 hover:text-primary dark:hover:text-primary transition-colors" href="{{ route('landing') }}#hero">Home</a>
                
                <!-- Menu Planos com Submenu -->
                <div class="relative group">
                    <a class="text-sm font-medium text-zinc-600 dark:text-zinc-300 hover:text-primary dark:hover:text-primary transition-colors cursor-pointer flex items-center gap-1" href="{{ route('landing') }}#planos">
                        Planos
                        <svg class="w-4 h-4 dropdown-arrow group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    
                    <!-- Submenu Dropdown -->
                    <div class="absolute top-full left-0 mt-2 w-64 bg-white/95 dark:bg-zinc-800/95 dropdown-menu custom-shadow rounded-lg border border-zinc-200 dark:border-zinc-700 opacity-0 invisible transition-all duration-300 group-hover:opacity-100 group-hover:visible transform translate-y-2 group-hover:translate-y-0">
                        <div class="py-2">
                            <!-- Planos hardcoded para consistência -->
                            <div class="px-4 py-3 dropdown-item hover:bg-zinc-50 dark:hover:bg-zinc-700 border-l-4 border-zinc-300 dark:border-zinc-600">
                                <a href="{{ route('plan.basic') }}" class="block">
                                    <h4 class="font-semibold text-zinc-900 dark:text-white">Basic</h4>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400 font-medium">R$ 79,90</p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-500 mt-1">Ideal para iniciantes</p>
                                </a>
                            </div>
                            <div class="px-4 py-3 dropdown-item hover:bg-zinc-50 dark:hover:bg-zinc-700 border-l-4 border-orange-500">
                                <a href="{{ route('plan.smart') }}" class="block">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h4 class="font-semibold text-zinc-900 dark:text-white">Smart</h4>
                                        <span class="px-2 py-1 text-xs font-bold text-white bg-orange-500 rounded-full">POPULAR</span>
                                    </div>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400 font-medium">R$ 129,90</p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-500 mt-1">Mais popular entre nossos alunos</p>
                                </a>
                            </div>
                            <div class="px-4 py-3 dropdown-item hover:bg-zinc-50 dark:hover:bg-zinc-700 border-l-4 border-zinc-800 dark:border-zinc-200">
                                <a href="{{ route('plan.black') }}" class="block">
                                    <h4 class="font-semibold text-zinc-900 dark:text-white">Black</h4>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400 font-medium">R$ 199,90</p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-500 mt-1">Premium e completo</p>
                                </a>
                            </div>
                            
                            <div class="border-t border-zinc-200 dark:border-zinc-700 mt-2 pt-2 mx-4">
                                <a href="{{ route('comparison.index') }}" class="block px-4 py-2 text-sm font-medium text-primary hover:text-primary/80 transition-colors dropdown-item">
                                    Ver Todos os Planos →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Menu Comparação com Submenu -->
                <div class="relative group">
                    <a class="text-sm font-medium text-zinc-600 dark:text-zinc-300 hover:text-primary dark:hover:text-primary transition-colors cursor-pointer flex items-center gap-1" href="{{ route('landing') }}#comparacao">
                        Comparação
                        <svg class="w-4 h-4 dropdown-arrow group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    
                    <!-- Submenu Dropdown -->
                    <div class="absolute top-full left-0 mt-2 w-64 bg-white/95 dark:bg-zinc-800/95 dropdown-menu custom-shadow rounded-lg border border-zinc-200 dark:border-zinc-700 opacity-0 invisible transition-all duration-300 group-hover:opacity-100 group-hover:visible transform translate-y-2 group-hover:translate-y-0">
                        <div class="py-2">
                            <div class="px-4 py-3 dropdown-item hover:bg-zinc-50 dark:hover:bg-zinc-700 border-l-4 border-primary">
                                <a href="{{ route('comparison.index') }}" class="block">
                                    <h4 class="font-semibold text-zinc-900 dark:text-white">Comparação Completa</h4>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400 font-medium">Todos os Planos</p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-500 mt-1">Veja todos os benefícios e recursos</p>
                                </a>
                            </div>
                            
                            <div class="px-4 py-3 dropdown-item hover:bg-zinc-50 dark:hover:bg-zinc-700 border-l-4 border-zinc-300 dark:border-zinc-600">
                                <a href="{{ route('comparison.prices') }}" class="block">
                                    <h4 class="font-semibold text-zinc-900 dark:text-white">Preços</h4>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400 font-medium">Tabela de Valores</p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-500 mt-1">Compare preços e promoções</p>
                                </a>
                            </div>
                            
                            <div class="px-4 py-3 dropdown-item hover:bg-zinc-50 dark:hover:bg-zinc-700 border-l-4 border-zinc-300 dark:border-zinc-600">
                                <a href="{{ route('comparison.benefits') }}" class="block">
                                    <h4 class="font-semibold text-zinc-900 dark:text-white">Benefícios</h4>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400 font-medium">Recursos Inclusos</p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-500 mt-1">O que cada plano oferece</p>
                                </a>
                            </div>
                            
                            <div class="border-t border-zinc-200 dark:border-zinc-700 mt-2 pt-2 mx-4">
                                <a href="{{ route('comparison.index') }}" class="block px-4 py-2 text-sm font-medium text-primary hover:text-primary/80 transition-colors dropdown-item">
                                    Ver Comparação Completa →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Menu Locais com Submenu -->
                <div class="relative group">
                    <a class="text-sm font-medium text-zinc-600 dark:text-zinc-300 hover:text-primary dark:hover:text-primary transition-colors cursor-pointer flex items-center gap-1" href="{{ route('landing') }}#locais">
                        Locais
                        <svg class="w-4 h-4 dropdown-arrow group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    
                    <!-- Submenu Dropdown -->
                    <div class="absolute top-full left-0 mt-2 w-64 bg-white/95 dark:bg-zinc-800/95 dropdown-menu custom-shadow rounded-lg border border-zinc-200 dark:border-zinc-700 opacity-0 invisible transition-all duration-300 group-hover:opacity-100 group-hover:visible transform translate-y-2 group-hover:translate-y-0">
                        <div class="py-2">
                            <div class="px-4 py-3 dropdown-item hover:bg-zinc-50 dark:hover:bg-zinc-700 border-l-4 border-primary">
                                <a href="{{ route('unit.show', 'centro') }}" class="block">
                                    <h4 class="font-semibold text-zinc-900 dark:text-white">Centro</h4>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400 font-medium">Av. Paulista, 1000</p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-500 mt-1">Academia completa com equipamentos modernos</p>
                                </a>
                            </div>
                            
                            <div class="px-4 py-3 dropdown-item hover:bg-zinc-50 dark:hover:bg-zinc-700 border-l-4 border-zinc-300 dark:border-zinc-600">
                                <a href="{{ route('unit.show', 'zona-sul') }}" class="block">
                                    <h4 class="font-semibold text-zinc-900 dark:text-white">Zona Sul</h4>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400 font-medium">Rua Augusta, 500</p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-500 mt-1">Foco em aulas em grupo e pilates</p>
                                </a>
                            </div>
                            
                            <div class="px-4 py-3 dropdown-item hover:bg-zinc-50 dark:hover:bg-zinc-700 border-l-4 border-zinc-300 dark:border-zinc-600">
                                <a href="{{ route('unit.show', 'zona-oeste') }}" class="block">
                                    <h4 class="font-semibold text-zinc-900 dark:text-white">Zona Oeste</h4>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400 font-medium">Av. Faria Lima, 2000</p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-500 mt-1">Instalações premium com personal trainers</p>
                                </a>
                            </div>
                            
                            <div class="border-t border-zinc-200 dark:border-zinc-700 mt-2 pt-2 mx-4">
                                <a href="{{ route('units.index') }}" class="block px-4 py-2 text-sm font-medium text-primary hover:text-primary/80 transition-colors dropdown-item">
                                    Ver Todas as Unidades →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="flex items-center gap-2">
                @if(auth()->check())
                    <span class="text-sm text-zinc-600 dark:text-zinc-300">Olá, {{ auth()->user()->name }}</span>
                    <a href="{{ route('logout.get') }}" class="px-4 py-2 text-sm font-bold text-zinc-600 dark:text-zinc-300 hover:text-primary transition-colors">Sair</a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-bold text-zinc-600 dark:text-zinc-300 hover:text-primary transition-colors">Entrar</a>
                    <a href="{{ route('cadastro') }}" class="px-4 py-2 text-sm font-bold text-white bg-primary rounded-lg hover:bg-primary/90 transition-colors">Cadastre-se</a>
                @endif
            </div>
        </div>
    </div>
</header>
