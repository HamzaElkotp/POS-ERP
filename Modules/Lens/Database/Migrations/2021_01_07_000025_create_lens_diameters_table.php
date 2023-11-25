<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLensDiametersTable extends Migration
{
    public function up()
    {
        Schema::create('lens_diameters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lens_diameter')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down()
    {
        Schema::dropIfExists('lens_diameters');
    }
}