<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Configuração de CORS para permitir requisições de diferentes origens.
    | Importante para APIs que serão consumidas por frontends em domínios diferentes.
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:3000',     // React/Vue local
        'http://localhost:8080',     // Vue local alternativo
        'http://localhost:4200',     // Angular local
        // Adicione seus domínios de produção aqui
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];

