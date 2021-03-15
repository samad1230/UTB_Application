<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('offer_id');
            $table->string('total_buy_amount');
            $table->string('total_buy_cost')->default(0);
            $table->string('total_buy_discount')->default(0);
            $table->string('last_buy_amount');
            $table->integer('payment_amount');
            $table->integer('supplier_id');
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
        Schema::dropIfExists('purchases');
    }
}
