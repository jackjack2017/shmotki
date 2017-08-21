<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEcomFilterOptionGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecom_filter_option_group', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('filter_id')->unsigned()->index();
            $table->foreign('filter_id')->references('id')->on('ecom_filters');

            $table->integer('option_group_id')->unsigned()->index();
            $table->foreign('option_group_id')->references('id')->on('ecom_option_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ecom_filter_option_group');
    }
}
