<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuotasTable extends Migration{
    
    public function up(){
        Schema::create('cuotas', function (Blueprint $table) {
        $table->id();

        $table->foreignId('evento_id')->constrained()->cascadeOnDelete();

        $table->string('tipo_apuesta');

        $table->decimal('cuota',8,2);

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuotas');
    }
}
