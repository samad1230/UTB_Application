<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalpurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localpurchases', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_no');
            $table->integer('supplier_id')->nullable();
            $table->string('amount');
            $table->string('expense')->nullable();
            $table->string('discount')->nullable();
            $table->string('due')->nullable();
            $table->string('date');
            $table->string('disburse_date')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('localpurchases');
    }
}
