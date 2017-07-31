<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEcomProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecom_products', function (Blueprint $table) {
            //Core fields donn`t remove
            $table->increments('id');

            $table->string('name');
            $table->index('name');

            $table->boolean('active')->default(0);
            $table->index('active');

            $table->string('slug')->nullable();
            $table->string('article')->nullable();

            $table->float('price')->nullable();
            $table->float('price_with_discount')->nullable();
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('main_image')->nullable();
            $table->string('images')->nullable();
            $table->string('file')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

            $table->integer('position');

            //Relations and indexes
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('ecom_categories');


            $table->timestamps();

            //Additional fields

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ecom_products');
    }
}
