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
<<<<<<< HEAD
        // Cria usuário administrador padrão (verifica se já existe)
        User::firstOrCreate(
            ['cpf' => '111.111.111-11'],
            [
                'name' => 'Administrador',
                'email' => 'admin@fitplanacademy.com',
                'phone' => '(11) 99999-1111',
                'cep' => '01001-000',
                'street' => 'Praça da Sé',
                'number' => '100',
                'district' => 'Sé',
                'city' => 'São Paulo',
                'state' => 'SP',
                'login' => 'ADMIN',
                'password' => Hash::make('password123'),
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
=======
        // Cria usuário administrador padrão
        User::create([
            'name' => 'Administrador',
            'cpf' => '111.111.111-11',
            'email' => 'admin@fitplanacademy.com',
            'phone' => '(11) 99999-1111',
            'cep' => '01001-000',
            'street' => 'Praça da Sé',
            'number' => '100',
            'district' => 'Sé',
            'city' => 'São Paulo',
            'state' => 'SP',
            'login' => 'ADMIN',
            'password' => Hash::make('password123'),
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
>>>>>>> 15e59356fe895e35c1f64dd742c7c4d0d9854d7c

        // Chama o seeder do usuário Master
        $this->call(MasterUserSeeder::class);

<<<<<<< HEAD
        // Cria usuário comum (Sophia) - verifica se já existe
        User::firstOrCreate(
            ['cpf' => '222.222.222-22'],
            [
                'name' => 'Sophia',
                'email' => 'sophia@fitplanacademy.com',
                'phone' => '(11) 99999-2222',
                'cep' => '01310-100',
                'street' => 'Av. Paulista',
                'number' => '1000',
                'district' => 'Bela Vista',
                'city' => 'São Paulo',
                'state' => 'SP',
                'login' => 'SOPHIA',
                'password' => Hash::make('password'),
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
=======
        // Cria usuário comum (Sophia)
        User::create([
            'name' => 'Sophia',
            'cpf' => '222.222.222-22',
            'email' => 'sophia@fitplanacademy.com',
            'phone' => '(11) 99999-2222',
            'cep' => '01310-100',
            'street' => 'Av. Paulista',
            'number' => '1000',
            'district' => 'Bela Vista',
            'city' => 'São Paulo',
            'state' => 'SP',
            'login' => 'SOPHIA',
            'password' => Hash::make('password'),
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
>>>>>>> 15e59356fe895e35c1f64dd742c7c4d0d9854d7c

        // Chama o seeder de planos
        $this->call(PlanSeeder::class);

        $this->command->info('✅ Usuários de teste criados com sucesso!');
<<<<<<< HEAD
        $this->command->info('📧 Master: master@fitplan.com.br (Senha: Master123)');
=======
        $this->command->info('📧 Master: master@fitplan.com.br (Senha: MasterPass)');
>>>>>>> 15e59356fe895e35c1f64dd742c7c4d0d9854d7c
        $this->command->info('📧 Sophia: sophia@fitplanacademy.com (Senha: password)');
    }
}

