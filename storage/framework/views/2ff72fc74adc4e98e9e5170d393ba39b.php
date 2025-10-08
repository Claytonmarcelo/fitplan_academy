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

    /* Aplicar multiplicador de fonte */
    body {
        font-size: calc(1rem * var(--font-size-multiplier));
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

    // Valores padrão
    const defaultFontSize = 1;
    const minFontSize = 0.8;
    const maxFontSize = 1.5;
    const fontSizeStep = 0.1;

    // Carregar configurações salvas
    function loadSettings() {
        const savedFontSize = localStorage.getItem('accessibility-font-size');
        const savedContrast = localStorage.getItem('accessibility-contrast');
        
        if (savedFontSize) {
            document.documentElement.style.setProperty('--font-size-multiplier', savedFontSize);
            updateFontDisplay(parseFloat(savedFontSize));
        }
        
        if (savedContrast === 'high') {
            document.body.classList.add('high-contrast');
            updateContrastUI(true);
        }
    }

    // Salvar configurações
    function saveSettings() {
        const fontSize = document.documentElement.style.getPropertyValue('--font-size-multiplier') || '1';
        const isHighContrast = document.body.classList.contains('high-contrast');
        
        localStorage.setItem('accessibility-font-size', fontSize);
        localStorage.setItem('accessibility-contrast', isHighContrast ? 'high' : 'normal');
    }

    // Atualizar display do tamanho da fonte
    function updateFontDisplay(size) {
        if (size === 1) {
            fontSizeDisplay.textContent = 'A';
        } else if (size < 1) {
            fontSizeDisplay.textContent = 'A-';
        } else {
            fontSizeDisplay.textContent = 'A+';
        }
    }

    // Atualizar UI do contraste
    function updateContrastUI(isHighContrast) {
        if (isHighContrast) {
            contrastIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>';
        } else {
            contrastIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>';
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
        
        document.documentElement.style.setProperty('--font-size-multiplier', newSize);
        updateFontDisplay(newSize);
        saveSettings();
    });

    // Aumentar fonte
    fontIncrease.addEventListener('click', function() {
        const currentSize = parseFloat(document.documentElement.style.getPropertyValue('--font-size-multiplier') || '1');
        const newSize = Math.min(currentSize + fontSizeStep, maxFontSize);
        
        document.documentElement.style.setProperty('--font-size-multiplier', newSize);
        updateFontDisplay(newSize);
        saveSettings();
    });

    // Reset configurações
    resetButton.addEventListener('click', function() {
        // Reset fonte
        document.documentElement.style.setProperty('--font-size-multiplier', defaultFontSize);
        updateFontDisplay(defaultFontSize);
        
        // Reset contraste
        document.body.classList.remove('high-contrast');
        updateContrastUI(false);
        
        // Limpar localStorage
        localStorage.removeItem('accessibility-font-size');
        localStorage.removeItem('accessibility-contrast');
        
        // Feedback visual
        resetButton.style.transform = 'scale(1.2)';
        setTimeout(() => {
            resetButton.style.transform = 'scale(1)';
        }, 200);
    });

    // Carregar configurações ao inicializar
    loadSettings();
});
</script>
<?php /**PATH /Users/eduardocruz/fitplan_acadamy/resources/views/components/accessibility-bar.blade.php ENDPATH**/ ?>