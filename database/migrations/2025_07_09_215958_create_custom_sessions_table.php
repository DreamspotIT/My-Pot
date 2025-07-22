<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomSessionsTable extends Migration
{ 
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id(); // id INT AUTO_INCREMENT PRIMARY KEY
            $table->unsignedBigInteger('user_id');
            $table->string('token', 255);
            $table->dateTime('expiresAt');
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
