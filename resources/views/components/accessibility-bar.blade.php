<!-- Barra de Acessibilidade -->
<div id="accessibility-bar" class="fixed top-0 left-0 right-0 z-50 bg-zinc-800 dark:bg-zinc-900 border-b border-zinc-700 dark:border-zinc-600 px-4 py-2">
    <div class="container mx-auto flex items-center justify-between">
        <!-- Logo e título -->
        <div class="flex items-center gap-3">
            <div class="text-primary size-6">
                <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path d="M42.1739 20.1739L27.8261 5.82609C29.1366 7.13663 28.3989 10.1876 26.2002 13.7654C24.8538 15.9564 22.9595 18.3449 20.6522 20.6522C18.3449 22.9595 15.9564 24.8538 13.7654 26.2002C10.1876 28.3989 7.13663 29.1366 5.82609 27.8261L20.1739 42.1739C21.4845 43.4845 24.5355 42.7467 28.1133 40.548C30.3042 39.2016 32.6927 37.3073 35 35C37.3073 32.6927 39.2016 30.3042 40.548 28.1133C42.7467 24.5355 43.4845 21.4845 42.1739 20.1739Z" fill="currentColor"></path>
                </svg>
            </div>
            <span class="text-sm font-medium text-white">Acessibilidade</span>
        </div>

        <!-- Controles de Acessibilidade -->
        <div class="flex items-center gap-4">
            <!-- Contraste -->
            <div class="flex items-center gap-2">
                <button id="contrast-toggle" 
                        class="flex items-center gap-2 px-3 py-1.5 bg-zinc-700 hover:bg-zinc-600 text-white text-sm rounded-md transition-colors"
                        title="Alternar contraste">
                    <svg id="contrast-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                    <span id="contrast-text">Alto Contraste</span>
                </button>
            </div>

            <!-- Tamanho da Fonte -->
            <div class="flex items-center gap-2">
                <button id="font-decrease" 
                        class="flex items-center justify-center w-8 h-8 bg-zinc-700 hover:bg-zinc-600 text-white rounded-md transition-colors"
                        title="Diminuir fonte">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                    </svg>
                </button>
                
                <span id="font-size-display" class="text-sm text-white min-w-[3rem] text-center">100%</span>
                
                <button id="font-increase" 
                        class="flex items-center justify-center w-8 h-8 bg-zinc-700 hover:bg-zinc-600 text-white rounded-md transition-colors"
                        title="Aumentar fonte">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </button>
            </div>

            <!-- Reset -->
            <button id="accessibility-reset" 
                    class="px-3 py-1.5 bg-zinc-700 hover:bg-zinc-600 text-white text-sm rounded-md transition-colors"
                    title="Restaurar configurações padrão">
                Reset
            </button>
        </div>
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

    /* Modo alto contraste */
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

    /* Ajustar posicionamento do conteúdo quando a barra está visível */
    body {
        padding-top: 3rem;
    }

    /* Transições suaves */
    * {
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }
</style>

<!-- JavaScript para funcionalidades de acessibilidade -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elementos
    const contrastToggle = document.getElementById('contrast-toggle');
    const contrastIcon = document.getElementById('contrast-icon');
    const contrastText = document.getElementById('contrast-text');
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
        const percentage = Math.round(size * 100);
        fontSizeDisplay.textContent = percentage + '%';
    }

    // Atualizar UI do contraste
    function updateContrastUI(isHighContrast) {
        if (isHighContrast) {
            contrastIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>';
            contrastText.textContent = 'Contraste Normal';
        } else {
            contrastIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>';
            contrastText.textContent = 'Alto Contraste';
        }
    }

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
        resetButton.textContent = 'Resetado!';
        setTimeout(() => {
            resetButton.textContent = 'Reset';
        }, 1000);
    });

    // Carregar configurações ao inicializar
    loadSettings();
});
</script>
