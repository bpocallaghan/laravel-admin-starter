<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_logins', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->string('username', 50);
            $table->string('status'); // success, no-user, inactive, disabled
            $table->string('role'); // website, admin
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
        Schema::drop('log_logins');
    }
}