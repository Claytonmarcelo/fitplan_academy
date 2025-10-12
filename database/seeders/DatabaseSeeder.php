<?php

namespace Database\Seeders;

use App\Features\User\Infrastructure\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Database Seeder
 * 
 * Seeder principal para popular o banco com dados iniciais.
 * 
 * Execute com: php artisan db:seed
 * 
 * @package Database\Seeders
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database
     */
    public function run(): void
    {
        // Cria usuário administrador padrão
        User::create([
            'name' => 'Administrador',
            'cpf' => '111.111.111-11',
            'email' => 'admin@fitplanacademy.com',
            'phone' => '(11) 99999-1111',
            'login' => 'ADMIN',
            'password' => Hash::make('password123'),
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Cria usuário de teste
        User::create([
            'name' => 'Usuário Teste',
            'cpf' => '222.222.222-22',
            'email' => 'teste@fitplanacademy.com',
            'phone' => '(11) 99999-2222',
            'login' => 'TESTE',
            'password' => Hash::make('password123'),
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Chama o seeder de planos
        $this->call(PlanSeeder::class);

        $this->command->info('✅ Usuários de teste criados com sucesso!');
        $this->command->info('📧 Admin: admin@fitplanacademy.com');
        $this->command->info('📧 Teste: teste@fitplanacademy.com');
        $this->command->info('🔑 Senha: password123');
    }
}

