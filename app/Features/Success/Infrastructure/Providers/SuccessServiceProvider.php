<?php

namespace App\Features\Success\Infrastructure\Providers;

use App\Features\Success\Domain\Repositories\SuccessRepositoryInterface;
use App\Features\Success\Infrastructure\Repositories\SuccessRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Service Provider para a feature Success
 * 
 * Registra todas as dependências da feature Success
 * Seguindo o padrão de injeção de dependência
 * 
 * @package App\Features\Success\Infrastructure\Providers
 * @author FitPlan Academy Team
 * @version 1.0.0
 */
class SuccessServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * 
     * Registra as dependências da feature Success
     */
    public function register(): void
    {
        // Registrar repositório
        $this->app->bind(
            SuccessRepositoryInterface::class,
            SuccessRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     * 
     * Inicializa serviços da feature Success
     */
    public function boot(): void
    {
        // Registrar views da feature (se necessário)
        // $this->loadViewsFrom(__DIR__ . '/../../Presentation/Views', 'success');
    }
}
