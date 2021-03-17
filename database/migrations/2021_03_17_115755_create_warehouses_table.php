<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->integer('recognition_item_id');
            $table->integer('purchase_type');
            $table->integer('product_id');
            $table->string('single_buy_price');
            $table->string('quantity');
            $table->string('total_buy');
            $table->string('rest_quantity');
            $table->string('rest_amount');
            $table->string('supplier_id');
            $table->string('purchase_date');
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
        Schema::dropIfExists('warehouses');
    }
}
