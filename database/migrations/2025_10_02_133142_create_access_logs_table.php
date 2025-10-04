<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration - Create Access Logs Table
 * 
 * Cria a tabela de logs de acesso para auditoria do sistema.
 * Armazena data, hora, nome, CPF e status do 2FA para cada acesso.
 * 
 * @package Database\Migrations
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('access_logs', function (Blueprint $table) {
            $table->id();
            
            // Referência ao usuário
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Dados do acesso
            $table->string('user_name', 60);
            $table->string('user_cpf', 14);
            $table->string('user_login', 6);
            
            // Informações de acesso
            $table->ipAddress('ip_address');
            $table->string('user_agent')->nullable();
            $table->boolean('two_factor_used')->default(false);
            $table->boolean('login_successful')->default(true);
            
            // Timestamps
            $table->timestamps();
            
            // Índices para consultas rápidas
            $table->index(['user_id', 'created_at']);
            $table->index(['user_cpf', 'created_at']);
            $table->index(['created_at', 'login_successful']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_logs');
    }
};
