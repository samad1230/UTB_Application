<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplieraccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplieraccounts', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id');
            $table->integer('warehouse_id')->nullable();
            $table->string('purchase_amount')->default(0);
            $table->string('payment')->default(0);
            $table->string('date');
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
        Schema::dropIfExists('supplieraccounts');
    }
}
