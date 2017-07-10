<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->string('question')->index();
            $table->string('slug')->index();
            $table->text('answer');
            $table->unsignedBigInteger('total_read')->default(0);
            $table->unsignedBigInteger('helpful_yes')->default(0);
            $table->unsignedBigInteger('helpful_no')->default(0);
            $table->unsignedBigInteger('category_id')->index();
            $table->unsignedBigInteger('list_order')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('faqs');
    }
}