<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigationWebsiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigation_website', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('html_title');
            $table->text('html_description')->nullable();
            $table->string('slug')->nullable();
            $table->string('url')->nullable();
            $table->string('icon')->nullable();
            $table->integer('is_main')->nullable();
            $table->integer('list_main_order')->nullable();
            $table->integer('is_footer')->nullable();
            $table->integer('list_footer_order')->nullable();
            $table->integer('is_hidden')->default(0);
            $table->integer('parent_id')->unsigned()->default(0);
            $table->integer('url_parent_id')->unsigned()->default(0);
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
        Schema::drop('navigation_website');
    }
}