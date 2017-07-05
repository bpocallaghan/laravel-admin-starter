<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Titan\Models\TitanCMSModel;

class SubscriptionPlanFeature extends TitanCMSModel
{
    use SoftDeletes;

    protected $table = 'subscription_plan_features';

    protected $guarded = ['id'];

    /**
     * Validation rules for this model
     */
    static public $rules = [
    	'title' => 'required|min:3:max:255',
    ];

	/**
	 * Get the SubscriptionPlan many to many
	 */
	public function subscriptionPlans()
	{
		return $this->belongsToMany(SubscriptionPlan::class, 'subscription_plan_feature_pivot');
	}
	
	/**
	 * Get all the rows as an array (ready for dropdowns)
	 *
	 * @return array
	 */
	public static function getAllList()
	{
		return self::orderBy('title')->get()->pluck('title', 'id')->toArray();
	}
}