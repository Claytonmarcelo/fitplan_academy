import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

/**
 * Configuração do Vite para Laravel
 * 
 * Vite é usado para compilar e otimizar assets do frontend.
 * 
 * @see https://vitejs.dev/config/
 */
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});

