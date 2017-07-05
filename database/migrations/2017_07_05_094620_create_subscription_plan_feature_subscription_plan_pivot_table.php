<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionPlanFeatureSubscriptionPlanPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_plan_feature_pivot', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->integer('list_order')->unsigned()->default(999);
            $table->integer('subscription_plan_feature_id')->unsigned();
            $table->integer('subscription_plan_id')->unsigned();

            //$table->integer('subscription_plan_feature_id')->unsigned()->index();
            //$table->foreign('subscription_plan_feature_id')->references('id')->on('subscription_plan_features')->onDelete('cascade');
            //$table->integer('subscription_plan_id')->unsigned()->index();
            //$table->foreign('subscription_plan_id')->references('id')->on('subscription_plans')->onDelete('cascade');
            //$table->primary(['subscription_plan_feature_id', 'subscription_plan_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('subscription_plan_feature_pivot');
    }
}