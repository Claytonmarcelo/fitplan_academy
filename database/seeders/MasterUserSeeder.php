<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Master User Seeder
 * 
 * Cria o usuário Master inicial do sistema.
 * Executar: php artisan db:seed --class=MasterUserSeeder
 */
class MasterUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verifica se já existe um usuário master
        $existingMaster = DB::table('users')->where('profile', 'master')->first();
        
        if ($existingMaster) {
            $this->command->info('Usuário Master já existe no sistema.');
            return;
        }

        // Cria o usuário Master
        DB::table('users')->insert([
            'name' => 'Administrador Master',
            'cpf' => '000.000.000-00',
            'email' => 'master@fitplan.com.br',
            'phone' => '(11) 99999-9999',
            'cep' => '01000-000',
            'street' => 'Rua Master',
            'number' => '1',
            'complement' => 'Admin',
            'district' => 'Centro',
            'city' => 'São Paulo',
            'state' => 'SP',
            'login' => 'MASTER',
            'password' => Hash::make('Master123'), // Senha padrão: Master123
            'profile' => 'master',
            'is_active' => true,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('✅ Usuário Master criado com sucesso!');
        $this->command->info('📧 Email: master@fitplan.com.br');
        $this->command->info('🔑 Login: MASTER');
        $this->command->info('🔒 Senha: Master123');
        $this->command->warn('⚠️  IMPORTANTE: Altere a senha após o primeiro login!');
    }
}
