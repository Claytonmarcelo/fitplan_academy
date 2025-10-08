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
        Schema::table('users', function (Blueprint $table) {
            // Adicionar campos que faltam
            $table->date('birth_date')->nullable()->after('name');
            $table->enum('gender', ['M', 'F', 'O'])->nullable()->after('birth_date');
            $table->string('mother_name', 60)->nullable()->after('gender');
            $table->string('landline_phone', 15)->nullable()->after('phone');
            $table->string('zip_code', 9)->nullable()->after('state');
            
            // Renomear campo profile para role para consistência
            $table->renameColumn('profile', 'role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remover campos adicionados
            $table->dropColumn(['birth_date', 'gender', 'mother_name', 'landline_phone', 'zip_code']);
            
            // Renomear campo role de volta para profile
            $table->renameColumn('role', 'profile');
        });
    }
};
