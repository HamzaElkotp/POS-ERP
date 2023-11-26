<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mappings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('business_id')->nullable();
            $table->bigInteger('stock_acc_id')->nullable();
            $table->bigInteger('discount_earned_acc_id')->nullable();
            $table->bigInteger('Value_added_tax_on_purchases_acc_id')->nullable();
            $table->bigInteger('shipping_expenses_acc_id')->nullable();
            $table->bigInteger('khazine_acc_id')->nullable();
            $table->bigInteger('sales_revenue_acc_id')->nullable();
            $table->bigInteger('cost_of_goods_acc_id')->nullable();
            $table->bigInteger('discount_permitted_acc_id')->nullable();
            $table->bigInteger('value_added_tax_on_sales_acc_id')->nullable();
            $table->bigInteger('shipping_revenue_acc_id')->nullable();
            $table->bigInteger('suppliers_acc_id')->nullable();
            $table->bigInteger('customers_acc_id')->nullable();
           
            $table->bigInteger('sales_tax_acc_id')->nullable();
            $table->bigInteger('sales_perc_acc_id')->nullable();
            $table->bigInteger('purch_tax_acc_id')->nullable();
            $table->bigInteger('purch_perc_acc_id')->nullable();
            $table->bigInteger('expense_acc')->nullable();
            $table->bigInteger('current_assets_acc_id')->nullable();
            $table->bigInteger('income_papers_acc_id')->nullable();
            $table->bigInteger('madinon_acc_id')->nullable();
            $table->bigInteger('sales_incentive_acc_id')->nullable();
            $table->bigInteger('service_income_acc_id')->nullable();
            $table->bigInteger('daenon_acc_id')->nullable();
            $table->bigInteger('expense_papers_acc_id')->nullable();
            $table->bigInteger('fixed_assets_acc_id')->nullable();
            $table->bigInteger('currency')->nullable();
            $table->bigInteger('invoice_items_count')->nullable();
            $table->bigInteger('stock_acc_id')->nullable();
            $table->bigInteger('damaged_stock_acc_id')->nullable();
            $table->bigInteger('ingred_store_acc_id')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mappings');
    }
};
