<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('description')->nullable();
            $table->text('emails')->nullable();
            $table->string('email_templates')->nullable();
            $table->string('events')->nullable();
            $table->string('subject')->nullable();
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
        Schema::drop('emails_lists');
    }
}
