<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogSocialShares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_social_shares', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->string('type');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image');
            $table->string('url');
            $table->string('client_ip');
            $table->string('client_agent');
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
        Schema::drop('log_social_shares');
    }
}