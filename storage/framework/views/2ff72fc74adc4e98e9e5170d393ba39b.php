<!-- Ícones de Acessibilidade Flutuantes -->
<div id="accessibility-floating" class="fixed right-4 top-1/2 transform -translate-y-1/2 z-50 flex flex-col gap-2">
    <!-- Botão Libras -->
    <button id="libras-toggle" 
            class="flex items-center justify-center w-12 h-12 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg transition-all duration-300 hover:scale-110"
            title="Libras - Língua Brasileira de Sinais">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
        </svg>
    </button>

    <!-- Botão Contraste -->
    <button id="contrast-toggle" 
            class="flex items-center justify-center w-12 h-12 bg-gray-600 hover:bg-gray-700 text-white rounded-full shadow-lg transition-all duration-300 hover:scale-110"
            title="Alto Contraste">
        <svg id="contrast-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
        </svg>
    </button>

    <!-- Botão Diminuir Fonte -->
    <button id="font-decrease" 
            class="flex items-center justify-center w-12 h-12 bg-gray-600 hover:bg-gray-700 text-white rounded-full shadow-lg transition-all duration-300 hover:scale-110"
            title="Diminuir fonte">
        <span class="text-lg font-bold">A-</span>
    </button>

    <!-- Botão Aumentar Fonte -->
    <button id="font-increase" 
            class="flex items-center justify-center w-12 h-12 bg-gray-600 hover:bg-gray-700 text-white rounded-full shadow-lg transition-all duration-300 hover:scale-110"
            title="Aumentar fonte">
        <span class="text-lg font-bold">A+</span>
    </button>

    <!-- Botão Reset -->
    <button id="accessibility-reset" 
            class="flex items-center justify-center w-12 h-12 bg-red-600 hover:bg-red-700 text-white rounded-full shadow-lg transition-all duration-300 hover:scale-110"
            title="Restaurar configurações padrão">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
        </svg>
    </button>

    <!-- Indicador de Tamanho da Fonte -->
    <div id="font-size-indicator" 
         class="flex items-center justify-center w-12 h-8 bg-gray-800 text-white text-xs rounded-full shadow-lg">
        <span id="font-size-display">A</span>
    </div>
</div>

<!-- CSS para acessibilidade -->
<style>
    /* Variáveis CSS para controle de fonte */
    :root {
        --font-size-multiplier: 1;
        --accessibility-contrast: normal;
    }

    /* Aplicar multiplicador de fonte globalmente */
    html {
        font-size: calc(16px * var(--font-size-multiplier));
    }
    
    /* Aplicar redimensionamento apenas aos elementos de texto */
    body {
        font-size: calc(1rem * var(--font-size-multiplier));
    }
    
    /* Redimensionar elementos de texto específicos */
    p, span, div, a, button, input, textarea, select, label, li, td, th, small, strong, em, b, i {
        font-size: calc(1em * var(--font-size-multiplier)) !important;
    }
    
    /* Redimensionar títulos com proporções adequadas */
    h1 {
        font-size: calc(2.25rem * var(--font-size-multiplier)) !important;
    }
    
    h2 {
        font-size: calc(1.875rem * var(--font-size-multiplier)) !important;
    }
    
    h3 {
        font-size: calc(1.5rem * var(--font-size-multiplier)) !important;
    }
    
    h4 {
        font-size: calc(1.25rem * var(--font-size-multiplier)) !important;
    }
    
    h5 {
        font-size: calc(1.125rem * var(--font-size-multiplier)) !important;
    }
    
    h6 {
        font-size: calc(1rem * var(--font-size-multiplier)) !important;
    }
    
    /* Classes de tamanho do Tailwind */
    .text-xs { font-size: calc(0.75rem * var(--font-size-multiplier)) !important; }
    .text-sm { font-size: calc(0.875rem * var(--font-size-multiplier)) !important; }
    .text-base { font-size: calc(1rem * var(--font-size-multiplier)) !important; }
    .text-lg { font-size: calc(1.125rem * var(--font-size-multiplier)) !important; }
    .text-xl { font-size: calc(1.25rem * var(--font-size-multiplier)) !important; }
    .text-2xl { font-size: calc(1.5rem * var(--font-size-multiplier)) !important; }
    .text-3xl { font-size: calc(1.875rem * var(--font-size-multiplier)) !important; }
    .text-4xl { font-size: calc(2.25rem * var(--font-size-multiplier)) !important; }
    .text-5xl { font-size: calc(3rem * var(--font-size-multiplier)) !important; }
    .text-6xl { font-size: calc(3.75rem * var(--font-size-multiplier)) !important; }
    
    /* Preservar tamanhos de ícones e elementos não-texto */
    svg, .icon, .material-symbols-outlined, .fas, .far, .fab, .fa, .w-4, .w-5, .w-6, .w-8, .w-12, .h-4, .h-5, .h-6, .h-8, .h-12 {
        font-size: inherit !important;
    }

    /* Modo alto contraste - Padrão Gov.br */
    .high-contrast {
        --accessibility-contrast: high;
    }

    .high-contrast body {
        background-color: #000000 !important;
        color: #ffffff !important;
    }

    .high-contrast .bg-white,
    .high-contrast .bg-background-light {
        background-color: #000000 !important;
        color: #ffffff !important;
    }

    .high-contrast .bg-zinc-800,
    .high-contrast .bg-zinc-900,
    .high-contrast .bg-background-dark {
        background-color: #000000 !important;
        color: #ffffff !important;
    }

    .high-contrast .text-zinc-900,
    .high-contrast .text-zinc-800,
    .high-contrast .text-zinc-700,
    .high-contrast .text-zinc-600,
    .high-contrast .text-zinc-500,
    .high-contrast .text-zinc-400,
    .high-contrast .text-zinc-300,
    .high-contrast .text-zinc-200 {
        color: #ffffff !important;
    }

    .high-contrast .border-zinc-200,
    .high-contrast .border-zinc-300,
    .high-contrast .border-zinc-400,
    .high-contrast .border-zinc-500,
    .high-contrast .border-zinc-600,
    .high-contrast .border-zinc-700,
    .high-contrast .border-zinc-800 {
        border-color: #ffffff !important;
    }

    .high-contrast .bg-primary {
        background-color: #ffffff !important;
        color: #000000 !important;
    }

    .high-contrast .text-primary {
        color: #ffffff !important;
    }

    /* Transições suaves */
    * {
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }

    /* Estilo dos ícones no modo alto contraste */
    .high-contrast #accessibility-floating button {
        border: 2px solid #ffffff !important;
    }

    .high-contrast #accessibility-floating .bg-gray-600 {
        background-color: #333333 !important;
    }

    .high-contrast #accessibility-floating .bg-gray-800 {
        background-color: #000000 !important;
        border: 2px solid #ffffff !important;
    }

    /* Animação de entrada */
    #accessibility-floating {
        animation: slideInRight 0.5s ease-out;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100px) translateY(-50%);
            opacity: 0;
        }
        to {
            transform: translateX(0) translateY(-50%);
            opacity: 1;
        }
    }

    /* Responsividade */
    @media (max-width: 768px) {
        #accessibility-floating {
            right: 2rem;
            gap: 1rem;
        }
        
        #accessibility-floating button {
            width: 3rem;
            height: 3rem;
        }
        
        #font-size-indicator {
            width: 3rem;
            height: 2rem;
        }
    }
</style>

<!-- JavaScript para funcionalidades de acessibilidade -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elementos
    const librasToggle = document.getElementById('libras-toggle');
    const contrastToggle = document.getElementById('contrast-toggle');
    const contrastIcon = document.getElementById('contrast-icon');
    const fontDecrease = document.getElementById('font-decrease');
    const fontIncrease = document.getElementById('font-increase');
    const fontSizeDisplay = document.getElementById('font-size-display');
    const resetButton = document.getElementById('accessibility-reset');

    // Verificar se os elementos existem
    const requiredElements = {
        fontDecrease,
        fontIncrease,
        fontSizeDisplay,
        resetButton,
        contrastToggle,
        contrastIcon,
        librasToggle
    };
    
    const missingElements = Object.entries(requiredElements)
        .filter(([name, element]) => !element)
        .map(([name]) => name);
    
    if (missingElements.length > 0) {
        console.error('Elementos de acessibilidade não encontrados:', missingElements);
        return;
    }
    
    console.log('Todos os elementos de acessibilidade carregados com sucesso');

    // Valores padrão
    const defaultFontSize = 1;
    const minFontSize = 0.8;
    const maxFontSize = 1.5;
    const fontSizeStep = 0.1;

    // Carregar configurações salvas
    function loadSettings() {
        const savedFontSize = localStorage.getItem('accessibility-font-size');
        const savedContrast = localStorage.getItem('accessibility-contrast');
        
        console.log('Carregando configurações:', { savedFontSize, savedContrast });
        
        if (savedFontSize) {
            const fontSize = parseFloat(savedFontSize);
            document.documentElement.style.setProperty('--font-size-multiplier', fontSize);
            updateFontDisplay(fontSize);
            console.log('Fonte carregada:', fontSize);
        } else {
            // Definir valor padrão se não houver configuração salva
            document.documentElement.style.setProperty('--font-size-multiplier', '1');
            updateFontDisplay(1);
        }
        
        if (savedContrast === 'high') {
            document.body.classList.add('high-contrast');
            updateContrastUI(true);
            console.log('Alto contraste ativado');
        }
    }

    // Salvar configurações
    function saveSettings() {
        const fontSize = document.documentElement.style.getPropertyValue('--font-size-multiplier') || '1';
        const isHighContrast = document.body.classList.contains('high-contrast');
        
        console.log('Salvando configurações:', { fontSize, isHighContrast });
        
        localStorage.setItem('accessibility-font-size', fontSize);
        localStorage.setItem('accessibility-contrast', isHighContrast ? 'high' : 'normal');
        
        console.log('Configurações salvas com sucesso');
    }

    // Atualizar display do tamanho da fonte
    function updateFontDisplay(size) {
        console.log('Atualizando display da fonte:', size);
        if (size === 1) {
            fontSizeDisplay.textContent = 'A';
        } else if (size < 1) {
            fontSizeDisplay.textContent = 'A-';
        } else {
            fontSizeDisplay.textContent = 'A+';
        }
        
        // Adicionar classe para indicar estado
        fontSizeDisplay.className = 'flex items-center justify-center w-12 h-8 bg-gray-800 text-white text-xs rounded-full shadow-lg';
        if (size < 1) {
            fontSizeDisplay.classList.add('text-orange-400');
        } else if (size > 1) {
            fontSizeDisplay.classList.add('text-green-400');
        }
    }

    // Atualizar UI do contraste
    function updateContrastUI(isHighContrast) {
        console.log('Atualizando UI do contraste:', isHighContrast);
        if (contrastIcon) {
            if (isHighContrast) {
                contrastIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>';
            } else {
                contrastIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>';
            }
        } else {
            console.error('Ícone de contraste não encontrado!');
        }
    }

    // Toggle Libras (simulação)
    librasToggle.addEventListener('click', function() {
        // Simulação do botão Libras - pode ser expandido para integração real
        alert('Funcionalidade Libras ativada! Esta funcionalidade pode ser integrada com serviços de tradução em Libras.');
    });

    // Toggle contraste
    contrastToggle.addEventListener('click', function() {
        const isHighContrast = document.body.classList.contains('high-contrast');
        
        if (isHighContrast) {
            document.body.classList.remove('high-contrast');
            updateContrastUI(false);
        } else {
            document.body.classList.add('high-contrast');
            updateContrastUI(true);
        }
        
        saveSettings();
    });

    // Diminuir fonte
    fontDecrease.addEventListener('click', function() {
        const currentSize = parseFloat(document.documentElement.style.getPropertyValue('--font-size-multiplier') || '1');
        const newSize = Math.max(currentSize - fontSizeStep, minFontSize);
        
        console.log('Diminuindo fonte:', currentSize, '->', newSize);
        document.documentElement.style.setProperty('--font-size-multiplier', newSize);
        updateFontDisplay(newSize);
        saveSettings();
        
        // Feedback visual
        this.style.transform = 'scale(0.9)';
        setTimeout(() => {
            this.style.transform = 'scale(1)';
        }, 150);
    });

    // Aumentar fonte
    fontIncrease.addEventListener('click', function() {
        const currentSize = parseFloat(document.documentElement.style.getPropertyValue('--font-size-multiplier') || '1');
        const newSize = Math.min(currentSize + fontSizeStep, maxFontSize);
        
        console.log('Aumentando fonte:', currentSize, '->', newSize);
        document.documentElement.style.setProperty('--font-size-multiplier', newSize);
        updateFontDisplay(newSize);
        saveSettings();
        
        // Feedback visual
        this.style.transform = 'scale(0.9)';
        setTimeout(() => {
            this.style.transform = 'scale(1)';
        }, 150);
    });

    // Reset configurações
    resetButton.addEventListener('click', function() {
        console.log('Reset de configurações de acessibilidade iniciado');
        
        // Reset fonte
        document.documentElement.style.setProperty('--font-size-multiplier', defaultFontSize);
        updateFontDisplay(defaultFontSize);
        console.log('Fonte resetada para:', defaultFontSize);
        
        // Reset contraste
        document.body.classList.remove('high-contrast');
        updateContrastUI(false);
        console.log('Contraste resetado');
        
        // Limpar localStorage
        localStorage.removeItem('accessibility-font-size');
        localStorage.removeItem('accessibility-contrast');
        console.log('LocalStorage limpo');
        
        // Feedback visual
        this.style.transform = 'scale(1.2)';
        setTimeout(() => {
            this.style.transform = 'scale(1)';
        }, 200);
        
        // Mostrar confirmação
        alert('Configurações de acessibilidade resetadas!');
        console.log('Reset concluído com sucesso');
    });

    // Carregar configurações ao inicializar
    loadSettings();
});
</script>
<?php /**PATH /Users/eduardocruz/fitplan_acadamy/resources/views/components/accessibility-bar.blade.php ENDPATH**/ ?>