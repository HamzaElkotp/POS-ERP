<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLenTransactionPivotTable extends Migration
{
    public function up()
    {
        Schema::create('len_transaction', function (Blueprint $table) {
            $table->unsignedInteger('transaction_id');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
            $table->unsignedInteger('len_id');
            $table->foreign('len_id')->references('id')->on('lens')->onDelete('cascade');
           
            $table->Integer('lens_diam_id')->nullable();
            $table->float('quantity')->nullable();
            $table->float('sph')->nullable();
            $table->string('cyl')->nullable();
            $table->float('price')->nullable();
            $table->float('purch_price')->nullable();
            $table->float('sub_total')->nullable();
            $table->float('disc')->nullable();
            $table->string('barecode')->nullable();
            $table->timestamps();
            $table->softDeletes();


        });
    }
    public function down()
    {
        Schema::dropIfExists('len_transaction');
    }
}
