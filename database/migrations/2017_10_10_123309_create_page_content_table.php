<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_content', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->integer('page_id')->unsigned()->index();
            $table->string('heading')->nullable();
            $table->string('heading_element')->default('h2');
            $table->string('heading_class')->nullable();
            $table->text('content')->nullable();
            $table->string('media')->nullable();
            $table->string('media_align', 50)->default('left');
            $table->string('caption')->nullable();
            $table->integer('list_order')->default(99);
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
        Schema::drop('page_content');
    }
}