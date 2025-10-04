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
        Schema::create('student_workouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('workout_name'); // Ex: "Série A - Pernas"
            $table->integer('duration_minutes'); // Duração em minutos
            $table->json('exercises'); // Array de exercícios com séries e repetições
            $table->boolean('completed')->default(false); // Se foi concluído
            $table->timestamp('started_at')->nullable(); // Quando começou (se completou)
            $table->timestamp('completed_at')->nullable(); // Quando terminou
            $table->timestamps();

            // Foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Índices
            $table->index(['user_id', 'created_at']);
            $table->index(['completed', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_workouts');
    }
};