<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->uuid('torneo_id'); // Cambiar a uuid
            $table->foreign('torneo_id')->references('id')->on('torneos')->onDelete('cascade');
            $table->foreignId('tenista_1_id')->constrained('tenistas')->onDelete('cascade');
            $table->foreignId('tenista_2_id')->nullable()->constrained('tenistas')->onDelete('cascade');
            $table->string('ronda')->nullable();
            $table->integer('puntos_tenista_1')->nullable();
            $table->integer('puntos_tenista_2')->nullable();
            $table->dateTime('fecha')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
