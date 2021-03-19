<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashBlanchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_blanches', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('cash_title');
            $table->string('cash_details');
            $table->string('receipt');
            $table->string('decrypt');
            $table->string('blanch');
            $table->string('user_id');
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
        Schema::dropIfExists('cash_blanches');
    }
}
