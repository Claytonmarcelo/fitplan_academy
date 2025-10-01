<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration - Create Users Table
 * 
 * Cria a tabela de usuários no PostgreSQL com índices otimizados.
 * 
 * Performance Tips:
 * - Índice único em email para buscar rapidamente
 * - Índice em is_active para filtros
 * - Timestamps para auditoria
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
            
            // Dados do usuário
            $table->string('name');
            $table->string('email')->unique(); // Índice único para performance
            $table->string('password');
            
            // Status do usuário
            $table->boolean('is_active')->default(true)->index(); // Índice para filtros
            
            // Verificação de email
            $table->timestamp('email_verified_at')->nullable();
            
            // Token de "remember me" para sessões web
            $table->rememberToken();
            
            // Timestamps de criação e atualização
            $table->timestamps();
            
            // Comentários para documentação no banco (PostgreSQL suporta)
            $table->comment('Tabela de usuários do sistema');
        });

        // Adiciona comentários nas colunas (específico do PostgreSQL)
        DB::statement('COMMENT ON COLUMN users.email IS \'Email único do usuário\'');
        DB::statement('COMMENT ON COLUMN users.is_active IS \'Indica se o usuário está ativo no sistema\'');
    }

    /**
     * Reverte as migrations
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

