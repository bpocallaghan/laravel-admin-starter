<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_actions', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->string('type', 50);
            $table->string('message');
            $table->bigInteger('subject_id')->unsigned()->index()->nullable();
            $table->string('subject_type')->index()->nullable();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
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
        Schema::drop('log_actions');
    }
}