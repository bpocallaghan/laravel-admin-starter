<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->string('name');
            $table->text('description');
            $table->string('email')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('telephone')->nullable();
            $table->string('fax')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('googleplus')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('address')->nullable();
            // geo location
            // google analytics
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
        Schema::drop('settings');
    }
}