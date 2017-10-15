<?php

namespace App\Http\Controllers\Admin\Settings;

use Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\SubscriptionPlanFeature;
use App\Http\Controllers\Admin\AdminController;

class FeaturesController extends AdminController
{
    /**
     * Display a listing of subscription_plan.
     *
     * @return Response
     */
    public function index()
    {
        save_resource_url();

        return $this->view('settings.subscription_plans.features.index')
            ->with('items', SubscriptionPlanFeature::all());
    }

    /**
     * Show the form for creating a new subscription_plan.
     *
     * @return Response
     */
    public function create()
    {
        return $this->view('settings.subscription_plans.features.add_edit');
    }

    /**
     * Store a newly created subscription_plan in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, SubscriptionPlanFeature::$rules,
            SubscriptionPlanFeature::$messages);

        $this->createEntry(SubscriptionPlanFeature::class, $request->only('title'));

        return redirect_to_resource();
    }

    /**
     * Show the form for editing the specified subscription_plan.
     *
     * @param SubscriptionPlanFeature $feature
     * @return Response
     */
    public function edit(SubscriptionPlanFeature $feature)
    {
        return $this->view('settings.subscription_plans.features.add_edit')
            ->with('item', $feature);
    }

    /**
     * Update the specified subscription_plan in storage.
     *
     * @param SubscriptionPlanFeature $feature
     * @param Request                 $request
     * @return Response
     */
    public function update(SubscriptionPlanFeature $feature, Request $request)
    {
        $this->validate($request, SubscriptionPlanFeature::$rules,
            SubscriptionPlanFeature::$messages);

        $this->updateEntry($feature, $request->only('title'));

        return redirect_to_resource();
    }

    /**
     * Remove the specified subscription_plan from storage.
     *
     * @param SubscriptionPlanFeature $feature
     * @param Request                 $request
     * @return Response
     */
    public function destroy(SubscriptionPlanFeature $feature, Request $request)
    {
        $this->deleteEntry($feature, $request);

        return redirect_to_resource();
    }
}
