<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLensTable extends Migration
{
    public function up()
    {
        Schema::create('lens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lens_type');
            $table->integer('business_id')->nullable();
            $table->float('allowed_disc', 5, 2)->nullable();
            $table->string('notes')->nullable();
            $table->string('signal_type_id')->nullable();
            $table->string('sph_from_id')->nullable();
            $table->string('sph_to_id')->nullable();
            $table->string('lens_diameter_id')->nullable();
            $table->string('branch_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down()
    {
        Schema::dropIfExists('lens');
    }
}
