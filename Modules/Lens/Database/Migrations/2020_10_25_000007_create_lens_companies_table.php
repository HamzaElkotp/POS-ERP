<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLensCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('lens_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
            $table->softDeletes();
            // $table->userstamps();
            // $table->softUserstamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('lens_companies');
    }
}
