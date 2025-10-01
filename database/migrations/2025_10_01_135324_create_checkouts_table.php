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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained('plans')->onDelete('cascade');
            $table->string('email');
            $table->string('password'); // Hash da senha
            $table->string('card_name');
            $table->string('card_number');
            $table->string('expiry_date');
            $table->string('cvc');
            $table->string('zip_code');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('taxes', 10, 2);
            $table->decimal('total', 10, 2);
            $table->string('status')->default('pending'); // pending, completed, failed
            $table->string('transaction_id')->nullable();
            $table->timestamps();
            
            // Índices para performance
            $table->index(['email', 'status']);
            $table->index(['plan_id', 'status']);
            $table->index('transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
