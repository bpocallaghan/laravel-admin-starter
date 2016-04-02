<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogAdminLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_admin_logins', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->string('email', 50);
            $table->string('message');
            $table->string('client_ip');
            $table->string('client_agent');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('log_admin_logins');
    }
}