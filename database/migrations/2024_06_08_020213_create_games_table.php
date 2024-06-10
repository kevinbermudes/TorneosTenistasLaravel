<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('torneo_id')->unsigned();
            $table->bigInteger('tenista1_id')->unsigned();
            $table->bigInteger('tenista2_id')->unsigned();
            $table->bigInteger('ganador_id')->unsigned()->nullable();
            $table->integer('ronda');
            $table->timestamps();

            $table->foreign('torneo_id')->references('idsecundario')->on('torneos')->onDelete('cascade');
            $table->foreign('tenista1_id')->references('id')->on('tenistas')->onDelete('cascade');
            $table->foreign('tenista2_id')->references('id')->on('tenistas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('games');
    }
}
