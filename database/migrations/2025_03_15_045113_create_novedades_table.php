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
        Schema::create('novedades', function (Blueprint $table) {
            $table->id();
            $table->enum('torre', ['1', '2', '3']);
            $table->enum('piso', ['s2', 's1', 'ss','1', '2', '3', '4', '5', '6', '7']);
            $table->string('area');
            $table->text('descripcion');
            $table->json('imagenes')->nullable();
            $table->string('usuario_reportador');
            $table->timestamps();
            $table->timestamp('fecha_hora_creacion')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('novedades');
    }
};
