<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSphFromsTable extends Migration
{
    public function up()
    {
        Schema::create('sph_froms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sph_from')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down()
    {
        Schema::dropIfExists('sph_froms');
    }
}
