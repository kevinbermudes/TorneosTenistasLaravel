<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('torneo_tenista', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('torneo_id')->unsigned();
            $table->foreign('torneo_id')->references('idsecundario')->on('torneos')->onDelete('cascade');
            $table->foreignId('tenista_id')->constrained()->onDelete('cascade');
            $table->integer('semilla')->nullable();
            $table->string('estado');
            $table->timestamps();

            $table->unique(['torneo_id', 'tenista_id'], 'unique_torneo_tenista');
        });
    }

    public function down()
    {
        Schema::dropIfExists('torneo_tenista');
    }
};
