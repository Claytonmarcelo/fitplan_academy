<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/**
 * Migration - Create Users Table
 * 
 * Cria a tabela de usuários no MySQL com todos os campos necessários.
 * Inclui campos para dados pessoais, endereço, credenciais e 2FA.
 * 
 * @package Database\Migrations
 */
return new class extends Migration
{
    /**
     * Executa as migrations
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            // Chave primária auto-increment
            $table->id();
            
            // Dados pessoais do usuário (validação 8-60 caracteres, só letras)
            $table->string('name', 60);
            $table->string('cpf', 14)->unique(); // 000.000.000-00
            
            // Dados de contato
            $table->string('email')->unique();
            $table->string('phone', 20); // (+55)XX-XXXXXXXX
            
            // Endereço completo
            $table->string('cep', 9); // 00000-000
            $table->string('street');
            $table->string('number', 10);
            $table->string('complement')->nullable();
            $table->string('district');
            $table->string('city');
            $table->string('state', 2);
            
            // Credenciais (login exatamente 6 caracteres alfabéticos)
            $table->string('login', 6)->unique();
            $table->string('password');
            
            // Perfil do usuário (Master ou Comum)
            $table->enum('profile', ['master', 'comum'])->default('comum');
            
            // Status do usuário
            $table->boolean('is_active')->default(true)->index();
            
            // Campos para 2FA
            $table->string('two_factor_secret')->nullable();
            $table->timestamp('two_factor_confirmed_at')->nullable();
            
            // Verificação de email
            $table->timestamp('email_verified_at')->nullable();
            
            // Token de "remember me" para sessões web
            $table->rememberToken();
            
            // Timestamps de criação e atualização
            $table->timestamps();
            
            // Índices para performance
            $table->index(['profile', 'is_active']);
            $table->index('cpf');
            $table->index('login');
        });

    }

    /**
     * Reverte as migrations
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

