<?php

/**
 * Bootstrap da aplicação Laravel 10
 * 
 * Este arquivo é responsável por inicializar a aplicação Laravel,
 * configurando o container de serviços e retornando a instância da aplicação.
 */

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/**
 * Vincular interfaces importantes
 * 
 * Aqui vinculamos as interfaces do Laravel aos seus respectivos
 * implementadores concretos. Isso permite que o framework resolva
 * as dependências automaticamente.
 */

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/**
 * Retornar a aplicação
 * 
 * Este script retorna a instância da aplicação. A instância
 * é dada para o script chamador para que possamos separar
 * a construção das instâncias da execução real.
 */

return $app;

