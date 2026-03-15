<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration{
    
    public function up(){
        Schema::create('eventos', function (Blueprint $table) {
        $table->id();

        $table->string('deporte');
        $table->string('equipo_local');
        $table->string('equipo_visitante');

        $table->dateTime('fecha');

        $table->string('estado')->default('pendiente');

        $table->timestamps();
    });
    }


    public function down(){
        Schema::dropIfExists('eventos');
    }
}
