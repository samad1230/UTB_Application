<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('product_details');
            $table->integer('brand_id');
            $table->string('skvalue')->nullable()->default(0);
            $table->integer('warranty')->nullable()->default(0);
            $table->string('Country_Of_Origin')->nullable()->default(0);
            $table->string('Made_in_Assemble')->nullable()->default(0);
            $table->string('stoke_status');
            $table->enum('status', array('0','1'))->default('1');
            $table->string('slag');
            $table->integer('create_by');
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
        Schema::dropIfExists('products');
    }
}
