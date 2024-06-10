<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('torneos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigIncrements('idsecundario')->unique();
            $table->string('nombre');
            $table->enum('modalidad', ['individual', 'dobles', 'mixto']);
            $table->enum('superficie', ['dura', 'arcilla', 'hierba']);
            $table->integer('vacantes');
            $table->enum('categoria', ['atp 250', 'atp 500', 'atp 1000']);
            $table->integer('premios');
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->string('imagen');
            $table->boolean('isDelete')->default(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('torneos');
    }
};
