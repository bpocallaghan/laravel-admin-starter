<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigationAdminRolePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigation_admin_role', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->integer('navigation_admin_id')->unsigned()->index();
            $table->integer('role_id')->unsigned()->index();
            $table->timestamps();

            //$table->integer('navigation_id')->unsigned()->index();
            //$table->foreign('navigation_id')->references('id')->on('navigations')->onDelete('cascade');
            //$table->integer('role_id')->unsigned()->index();
            //$table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            //$table->primary(['navigation_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('navigation_admin_role');
    }
}