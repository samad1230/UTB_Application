<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procategories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('subcategorie_id');
            $table->string('procat_image');
            $table->string('slag');
            $table->enum('status', array('0','1'))->default('1');
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
        Schema::dropIfExists('procategories');
    }
}
