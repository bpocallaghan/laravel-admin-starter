<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerPagePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_page', function (Blueprint $table) {
            $table->integer('banner_id')->unsigned()->index();
            //$table->foreign('banner_id')->references('id')->on('banners')->onDelete('cascade');
            $table->integer('page_id')->unsigned()->index();
            //$table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->primary(['banner_id', 'page_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('banner_page');
    }
}