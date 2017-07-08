<?php

namespace App\Http\Controllers\Website;

use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PricingController extends WebsiteController
{
	public function index()
	{
        $this->showPageBanner = false;
        $subscriptionPlans = SubscriptionPlan::with('features')->get();

        return $this->view('pricing', compact('subscriptionPlans'));
	}
}