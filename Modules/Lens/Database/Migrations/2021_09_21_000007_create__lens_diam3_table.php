<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLensDiam3Table extends Migration
{
    public function up()
    {
        Schema::create('lens_diam3', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('len_id');
            // $table->foreign('len_id')->references('id')->on('lens')->onDelete('cascade');
            // $table->unsignedInteger('lens_diam_id');
            // $table->foreign('lens_diam_id')->references('id')->on('lens_diam')->onDelete('cascade');
            $table->float('sph', 15, 2)->default(0);

            $table->integer('s00')->default(0);
            // $table->integer('s25')->default(0);
            // $table->integer('s50')->default(0);
            // $table->integer('s75')->default(0);
            // $table->integer('s100')->default(0);
            // $table->integer('s125')->default(0);
            // $table->integer('s150')->default(0);
            // $table->integer('s175')->default(0);
            // $table->integer('s200')->default(0);
            // $table->integer('s225')->default(0);
            // $table->integer('s250')->default(0);
            // $table->integer('s275')->default(0);
            // $table->integer('s300')->default(0);
            // $table->integer('s325')->default(0);
            // $table->integer('s350')->default(0);
            // $table->integer('s375')->default(0);
            // $table->integer('s400')->default(0);
            // $table->integer('s425')->default(0);
            // $table->integer('s450')->default(0);
            // $table->integer('s475')->default(0);
            // $table->integer('s500')->default(0);
            // $table->integer('s525')->default(0);
            // $table->integer('s550')->default(0);
            // $table->integer('s575')->default(0);
            // $table->integer('s600')->default(0);

            $table->integer('_s25')->default(0);
            $table->integer('_s50')->default(0);
            $table->integer('_s75')->default(0);
            $table->integer('_s100')->default(0);
            $table->integer('_s125')->default(0);
            $table->integer('_s150')->default(0);
            $table->integer('_s175')->default(0);
            $table->integer('_s200')->default(0);
            $table->integer('_s225')->default(0);
            $table->integer('_s250')->default(0);
            $table->integer('_s275')->default(0);
            $table->integer('_s300')->default(0);
            $table->integer('_s325')->default(0);
            $table->integer('_s350')->default(0);
            $table->integer('_s375')->default(0);
            $table->integer('_s400')->default(0);
            $table->integer('_s425')->default(0);
            $table->integer('_s450')->default(0);
            $table->integer('_s475')->default(0);
            $table->integer('_s500')->default(0);
            $table->integer('_s525')->default(0);
            $table->integer('_s550')->default(0);
            $table->integer('_s575')->default(0);
            $table->integer('_s600')->default(0);

            $table->timestamps();
            $table->softDeletes();


        });
    }
    public function down()
    {
        Schema::dropIfExists('lens_diam3');
    }
}