<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSphTosTable extends Migration
{
    public function up()
    {
        Schema::create('sph_tos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sph_to')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down()
    {
        Schema::dropIfExists('sph_tos');
    }
}
