<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration{
    
    public function up(){
        Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password');

        $table->decimal('saldo',10,2)->default(0);

        $table->string('role')->default('usuario');

        $table->string('otp_code')->nullable();
        $table->timestamp('otp_expiration')->nullable();

        $table->timestamps();
    });
    }

    public function down(){
        Schema::dropIfExists('users');
    }
}
