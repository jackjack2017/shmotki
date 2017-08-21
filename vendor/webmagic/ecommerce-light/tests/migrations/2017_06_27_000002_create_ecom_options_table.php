<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEcomOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecom_options', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');

            $table->string('value')->nullable();
            $table->integer('option_group_id')->nullable();
            $table->string('color')->nullable();
            $table->integer('position');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ecom_options');
    }
}
