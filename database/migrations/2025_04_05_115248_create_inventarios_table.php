<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventariosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_equipo');
            $table->string('pertenece');
            $table->string('serial_cpu')->unique();
            $table->string('serial_monitor')->unique();
            $table->string('serial_mac')->unique();
            $table->string('serial_fisico_monitor');
            $table->string('capacidad_disco');
            $table->string('tipo_disco');
            $table->string('capacidad_ram');
            $table->string('tipo_procesador');
            $table->string('marca_monitor');
            $table->string('area');
            $table->string('jefe_area');
            $table->string('torre');
            $table->string('ip_equipo')->unique();
            $table->string('sistema_operativo');
            $table->string('version_office');
            $table->string('tipo_antivirus');
            $table->boolean('perifericos');
            $table->string('marca_teclado')->nullable();
            $table->string('marca_mouse')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
}
