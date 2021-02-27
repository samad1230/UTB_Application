<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('offer_id');
            $table->integer('product_id');
            $table->string('buy_price');
            $table->integer('buy_qty');
            $table->string('buy_sub_total');
            $table->string('buy_cost')->default(0);
            $table->string('discount')->default(0);
            $table->string('actual_buy');
            $table->integer('rest_qty')->default(0);
            $table->string('rest_qty_buy_total')->default(0);
            $table->integer('sell_price')->default(0);
            $table->integer('sell_discount_price')->default(0);
            $table->integer('supplier_id');
            $table->string('purchase_date');
            $table->enum('purchase_type', array('0','1'))->default('1');
            $table->string('with_free')->default(0);
            $table->integer('status');
            $table->integer('user_id');
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
        Schema::dropIfExists('product_stocks');
    }
}
