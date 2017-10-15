<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_media', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->string('heading');
            $table->string('heading_element')->default('h1');
            $table->string('heading_class')->nullable();
            $table->string('media');
            $table->string('media_align', 50)->default('left');
            $table->string('caption')->nullable();
            $table->text('content');
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
        Schema::drop('page_media');
    }
}