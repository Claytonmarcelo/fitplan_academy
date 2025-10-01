/**
 * JavaScript Principal da Aplicação
 * 
 * Este arquivo é o ponto de entrada para o JavaScript do frontend.
 * Aqui você pode importar bibliotecas e inicializar componentes.
 */

import './bootstrap';

// Importar Alpine.js para interatividade
import Alpine from 'alpinejs';

// Disponibilizar Alpine globalmente
window.Alpine = Alpine;

// Iniciar Alpine
Alpine.start();

console.log('✅ FitPlan Academy - Frontend carregado!');

