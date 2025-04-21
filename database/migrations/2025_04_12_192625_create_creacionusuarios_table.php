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
        Schema::create('creacionusuarios', function (Blueprint $table) {
            $table->id();
            $table->string('primerApellido');
            $table->string('segundoApellido');
            $table->string('nombres');
            $table->string('sexo');
            $table->date('fechaNacimiento');
            $table->string('tipoDocumento');
            $table->string('numeroDocumento');
            $table->string('origen');
            $table->string('regMedico');
            $table->string('direccionDomicilio');
            $table->string('departamento');
            $table->string('ciudad');
            $table->string('barrio');
            $table->string('email');
            $table->string('celular');
            $table->string('tipoProfesion');
            $table->string('especialidad')->nullable();
            $table->string('tipoVinculacion');
            $table->string('cooperativa')->nullable();
            $table->string('sociedad')->nullable();
            $table->string('otroVinculacion')->nullable();
            $table->string('atencionGrupal');
            $table->text('serviciosOfrecidos')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creacionusuarios');
    }
};
