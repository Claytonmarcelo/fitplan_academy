<?php

namespace Database\Factories;

use App\Features\User\Infrastructure\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Factory para User Model
 * 
 * Gera dados fake para testes e seeders.
 * 
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * O nome do model correspondente
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define o estado padrão do model
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'is_active' => true,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Estado: Email não verificado
     *
     * @return static
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Estado: Usuário inativo
     *
     * @return static
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}

