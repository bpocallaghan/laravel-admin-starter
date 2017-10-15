<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoTagPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_tag', function (Blueprint $table) {
            //$table->increments('id')->unique()->index();
            $table->integer('photo_id')->unsigned()->index();
            //$table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
            $table->integer('tag_id')->unsigned()->index();
            //$table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->primary(['photo_id', 'tag_id']);
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('photo_tag');
    }
}