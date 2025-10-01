<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration - Create Personal Access Tokens Table
 * 
 * Tabela para tokens do Laravel Sanctum (autenticação de API).
 * 
 * Performance Tips:
 * - Índice em token para busca rápida
 * - Índice composto em tokenable para queries eficientes
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
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            
            // Polimorfismo: pode ser usado por diferentes models
            $table->morphs('tokenable');
            
            $table->string('name');
            $table->string('token', 64)->unique(); // Índice único para busca rápida
            $table->text('abilities')->nullable(); // Permissões do token (JSON)
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
            
            $table->comment('Tokens de acesso da API (Laravel Sanctum)');
        });

        // Índices adicionais para performance
        DB::statement('CREATE INDEX idx_personal_access_tokens_tokenable ON personal_access_tokens(tokenable_type, tokenable_id)');
    }

    /**
     * Reverte as migrations
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};

