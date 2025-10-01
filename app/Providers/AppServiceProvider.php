<?php

namespace App\Providers;

use App\Features\User\Domain\Repositories\UserRepositoryInterface;
use App\Features\User\Infrastructure\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

/**
 * App Service Provider
 * 
 * Service Provider principal da aplicação.
 * Responsável por registrar bindings de dependências (Dependency Injection).
 * 
 * Aqui mapeamos interfaces para suas implementações concretas,
 * seguindo o Dependency Inversion Principle (SOLID).
 * 
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Registra serviços no container
     * 
     * Aqui fazemos o binding de interfaces para implementações.
     * Isso permite que as camadas superiores dependam de abstrações,
     * não de implementações concretas.
     */
    public function register(): void
    {
        /**
         * Bind do UserRepository
         * 
         * Sempre que uma classe precisar de UserRepositoryInterface,
         * o Laravel injetará automaticamente uma instância de UserRepository.
         * 
         * Performance: Singleton garante uma única instância por request.
         */
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        // Adicione aqui outros bindings de repositórios conforme criar novas features
        // Exemplo:
        // $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }

    /**
     * Bootstrap de serviços da aplicação
     */
    public function boot(): void
    {
        //
    }
}

