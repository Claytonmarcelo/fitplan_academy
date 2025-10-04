<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_goals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title'); // Ex: "Perder 5kg"
            $table->text('description')->nullable();
            $table->string('type'); // peso, frequencia, força, etc
            $table->decimal('target_value', 10, 2); // Valor objetivo
            $table->string('target_unit', 10); // kg, dias, reps, etc
            $table->decimal('current_value', 10, 2)->default(0); // Valor atual
            $table->date('target_date'); // Data objetivo
            $table->boolean('is_achieved')->default(false); // Se foi alcançada
            $table->timestamp('achieved_at')->nullable(); // Quando foi alcançada
            $table->timestamps();

            // Foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Índices
            $table->index(['user_id', 'target_date']);
            $table->index(['is_achieved', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_goals');
    }
};