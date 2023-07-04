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
            $table->unsignedBigInteger('rol_id')->nullable();
            // Agrega una columna "rol_id" en la tabla "usuarios"

            $table->foreign('rol_id')->references('id')->on('roles');
            // Establece la relación con la tabla "roles"
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['rol_id']);
            $table->dropColumn('rol_id');
            // Elimina la columna "rol_id" de la tabla "usuarios"
        });
    }
};
