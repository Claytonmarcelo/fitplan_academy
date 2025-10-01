<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration - Create Password Reset Tokens Table
 * 
 * Tabela para armazenar tokens de reset de senha.
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
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
            
            $table->comment('Tokens para reset de senha');
        });
    }

    /**
     * Reverte as migrations
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};

