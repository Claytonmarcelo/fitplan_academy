<?php

namespace App\Features\Checkout\Infrastructure\Providers;

use App\Features\Checkout\Application\UseCases\ProcessCheckoutUseCase;
use App\Features\Checkout\Domain\Repositories\CheckoutRepositoryInterface;
use App\Features\Checkout\Infrastructure\Repositories\CheckoutRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Service Provider para Checkout
 * 
 * Registra as dependências do módulo de checkout
 */
class CheckoutServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Registrar interface do repositório
        $this->app->bind(
            CheckoutRepositoryInterface::class,
            CheckoutRepository::class
        );

        // Registrar use cases
        $this->app->bind(ProcessCheckoutUseCase::class, function ($app) {
            return new ProcessCheckoutUseCase(
                $app->make(CheckoutRepositoryInterface::class)
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
