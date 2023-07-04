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
        

        Schema::create('categoria', function (Blueprint $table) {
            $table->id();
            $table->string("etiqueta");
            $table->timestamps();
        });
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("descripcion");
            $table->decimal("precio");
            $table->unsignedBigInteger('categoria_id'); // Clave foránea para la relación con la tabla "caracteristicas"
            $table->foreign('categoria_id')->references('id')->on('categoria');
            // Indica que la clave foránea "caracteristicas_id" referencia a la columna "id" de la tabla "caracteristicas"
            $table->timestamps();
        });

        Schema::create('caracteristicas', function (Blueprint $table) {
            $table->id();
            $table->string("caracteristica");
            $table->timestamps();
            $table->unsignedBigInteger('productos_id'); // Clave foránea para la relación con la tabla "caracteristicas"
            $table->foreign('productos_id')->references('id')->on('productos');
            // Indica que la clave foránea "caracteristicas_id" referencia a la columna "id" de la tabla "caracteristicas"
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
        Schema::dropIfExists('caracteristicas');
        Schema::dropIfExists('categoria');
    }
};
