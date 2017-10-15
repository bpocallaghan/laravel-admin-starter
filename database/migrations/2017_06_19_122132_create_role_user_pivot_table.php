<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUserPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->integer('role_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();

            //$table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //$table->primary(['role_id', 'user_id']);
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
        Schema::drop('role_user');
    }
}