<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCylindersTable extends Migration
{
    public function up()
    {
        Schema::create('cylinders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cylinder')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down()
    {
        Schema::dropIfExists('cylinders');
    }
}