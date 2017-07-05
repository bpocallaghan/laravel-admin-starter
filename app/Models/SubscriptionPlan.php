<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Titan\Models\TitanCMSModel;

class SubscriptionPlan extends TitanCMSModel
{
    use SoftDeletes;

    protected $table = 'subscription_plans';

    protected $guarded = ['id'];

    /**
     * Validation rules for this model
     */
    static public $rules = [
        'title' => 'required|min:3:max:255',
        'cost'  => 'required|min:1:max:255',
    ];

    public function getFeaturesStringAttribute()
    {
        return implode(', ', $this->features()->get()->pluck('title', 'id')->toArray());
    }

	/**
	 * Get the SubscriptionPlanFeature many to many
	 */
	public function features()
	{
		return $this->belongsToMany(SubscriptionPlanFeature::class, 'subscription_plan_feature_pivot')->orderBy('list_order');
	}
}