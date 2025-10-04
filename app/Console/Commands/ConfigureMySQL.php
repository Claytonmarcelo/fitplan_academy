<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

/**
 * Comando para configurar e testar conexão MySQL
 */
class ConfigureMySQL extends Command
{
    protected $signature = 'mysql:setup {database} {username=root} {password=""}';
    protected $description = 'Configura e testa conexão MySQL rapidamente';

    public function handle()
    {
        $database = $this->argument('database');
        $username = $this->argument('username');
        $password = $this->argument('password');
        
        $this->info('🔧 Configurando MySQL...');
        
        // Configurar conexão temporária para teste
        config(['database.connections.temp_mysql' => [
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'port' => '3306',
            'database' => $database,
            'username' => $username,
            'password' => $password,
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
        ]]);
        
        // Testar conexão
        try {
            DB::connection('temp_mysql')->getPdo();
            $this->info("✅ Conexão MySQL estabelecida com sucesso!");
            $this->info("📊 Database: {$database}");
            $this->info("👤 Username: {$username}");
            
            // Verificar se existe tabela users
            try {
                $usersCount = DB::connection('temp_mysql')->table('users')->count();
                $this->info("👥 Usuários encontrados: {$usersCount}");
                
                if ($usersCount === 0) {
                    $this->warn('⚠️ Nenhum usuário encontrado. Execute:');
                    $this->warn('php artisan mysql:migrate');
                }
            } catch (\Exception $e) {
                $this->warn('⚠️ Tabelle "users" não existe. Execute:');
                $this->warn('php artisan mysql:migrate');
            }
            
        } catch (\Exception $e) {
            $this->error('❌ Erro de conexão MySQL:');
            $this->error($e->getMessage());
            $this->warn('');
            $this->warn('💡 Possíveis soluções:');
            $this->warn('1. Verificar se MySQL está rodando');
            $this->warn('2. Verificar credenciais (usuário/senha)');
            $this->warn('3. Criar database: CREATE DATABASE fitplan_academy;');
            $this->warn('4. Verificar permissões do usuário MySQL');
            return 1;
        }
        
        return 0;
    }
}