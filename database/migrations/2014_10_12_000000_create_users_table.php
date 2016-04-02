<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->index()->unique();
            $table->string('cellphone', 15)->nullable()->index();
            $table->string('image')->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('password', 60)->nullable();
            $table->rememberToken();
            $table->string('confirmation_token')->nullable();
            $table->timestamp('logged_in_at')->nullable();
            $table->timestamps();
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('registered_at')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
