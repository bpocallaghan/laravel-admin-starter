<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigationAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigation_admin', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('slug')->nullable();
            $table->string('url')->nullable();
            $table->string('icon')->nullable();
            $table->text('help_index_title')->nullable();
            $table->text('help_index_content')->nullable();
            $table->text('help_create_title')->nullable();
            $table->text('help_create_content')->nullable();
            $table->text('help_edit_title')->nullable();
            $table->text('help_edit_content')->nullable();
            $table->integer('list_order')->default(999);
            $table->tinyInteger('is_hidden')->default(0);
            $table->integer('parent_id')->default(0);
            $table->integer('url_parent_id')->default(0);
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
        Schema::drop('navigation_admin');
    }
}