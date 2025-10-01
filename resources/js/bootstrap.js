/**
 * Bootstrap JavaScript
 * 
 * Carrega e configura bibliotecas JavaScript necessárias.
 */

import axios from 'axios';

/**
 * Configuração do Axios para requisições HTTP
 * 
 * Todas as requisições incluirão:
 * - CSRF token nos headers
 * - Accept: application/json
 */
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['Accept'] = 'application/json';

/**
 * Echo e Pusher para WebSockets (opcional)
 * 
 * Descomente se for usar broadcasting em tempo real:
 * 
 * import Echo from 'laravel-echo';
 * import Pusher from 'pusher-js';
 * 
 * window.Pusher = Pusher;
 * 
 * window.Echo = new Echo({
 *     broadcaster: 'pusher',
 *     key: import.meta.env.VITE_PUSHER_APP_KEY,
 *     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
 *     forceTLS: true
 * });
 */

