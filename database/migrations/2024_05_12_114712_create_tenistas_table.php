<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tenistas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            //Ranking se calculara automaticamente con los puntos
            $table->integer('ranking');
            $table->string('pais');
            $table->date('FechaNacimiento');
            //La edad se calculara automaticamente con la fecha de nacimiento
            $table->integer('edad');
            $table->double('Altura');
            $table->double('peso');
            $table->enum('Mano', ['derecha', 'izquierda', 'ambidiestro']);
            $table->enum('reves', ['una mano', 'dos manos']);
            $table->string('entrenador');
            $table->string('totalDineroGanado');
            $table->integer('numeroVictorias');
            $table->integer('numeroDerrortas');
            $table->string('imagen');
            //se optendra al finalizar cada torneo
            $table->integer('puntos');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenistas');
    }
};
