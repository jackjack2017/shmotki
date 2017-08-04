<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CraeteEcomProductOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecom_product_option', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('ecom_products');

            $table->integer('option_id')->unsigned()->index();
            $table->foreign('option_id')->references('id')->on('ecom_options');

            $table->string('color')->nullable(); //temporary using for color functionality
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ecom_product_option');
    }
}
