<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageSectionsPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            //$table->boolean('is_active')->default(true); // when create a new one - manual 'activate' it
            $table->integer('page_id')->unsigned()->index();
            $table->integer('component_id')->unsigned()->index();
            $table->string('component_type')->index();
            $table->integer('list_order')->default(99);
            //$table->integer('parent_id')->unsigned()->default(0); // v2.0 when we drag sections to 'auto' the h1/h2/h3 etc headings
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
        Schema::drop('page_sections');
    }
}