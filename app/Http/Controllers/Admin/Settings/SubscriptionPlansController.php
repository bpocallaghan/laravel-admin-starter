<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Models\SubscriptionPlanFeature;
use Redirect;
use App\Http\Requests;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class SubscriptionPlansController extends AdminController
{
    /**
     * Display a listing of subscription_plan.
     *
     * @return Response
     */
    public function index()
    {
        save_resource_url();

        return $this->view('settings.subscription_plans.index')
            ->with('items', SubscriptionPlan::all());
    }

    /**
     * Show the form for creating a new subscription_plan.
     *
     * @return Response
     */
    public function create()
    {
        $features = SubscriptionPlanFeature::getAllList();

        return $this->view('settings.subscription_plans.add_edit')
            ->with('features', $features);
    }

    /**
     * Store a newly created subscription_plan in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, SubscriptionPlan::$rules, SubscriptionPlan::$messages);

        if (!$request->has('is_featured')) {
            $request->merge(['is_featured' => false]);
        }
        else {
            $request->merge(['is_featured' => true]);
        }

        $subscriptionPlan = $this->createEntry(SubscriptionPlan::class,
            $request->only('is_featured', 'title', 'cost', 'summary'));

        if ($subscriptionPlan) {
            $subscriptionPlan->features()->sync(input('features'));
        }

        return redirect_to_resource();
    }

    /**
     * Display the specified subscription_plan.
     *
     * @param SubscriptionPlan $subscription_plan
     * @return Response
     */
    public function show(SubscriptionPlan $subscription_plan)
    {
        return $this->view('settings.subscription_plans.show')
            ->with('item', $subscription_plan);
    }

    /**
     * Show the form for editing the specified subscription_plan.
     *
     * @param SubscriptionPlan $subscription_plan
     * @return Response
     */
    public function edit(SubscriptionPlan $subscription_plan)
    {
        $features = SubscriptionPlanFeature::getAllList();

        return $this->view('settings.subscription_plans.add_edit')
            ->with('item', $subscription_plan)
            ->with('features', $features);
    }

    /**
     * Update the specified subscription_plan in storage.
     *
     * @param SubscriptionPlan $subscription_plan
     * @param Request          $request
     * @return Response
     */
    public function update(SubscriptionPlan $subscription_plan, Request $request)
    {
        $this->validate($request, SubscriptionPlan::$rules, SubscriptionPlan::$messages);

        if (!$request->has('is_featured')) {
            $request->merge(['is_featured' => false]);
        }
        else {
            $request->merge(['is_featured' => true]);
        }

        $subscriptionPlan = $this->updateEntry($subscription_plan,
            $request->only('is_featured', 'title', 'cost', 'summary'));

        if ($subscriptionPlan) {
            $subscriptionPlan->features()->sync(input('features'));
        }

        return redirect_to_resource();
    }

    /**
     * Remove the specified subscription_plan from storage.
     *
     * @param SubscriptionPlan $subscription_plan
     * @param Request          $request
     * @return Response
     */
    public function destroy(SubscriptionPlan $subscription_plan, Request $request)
    {
        $this->deleteEntry($subscription_plan, $request);

        return redirect_to_resource();
    }

    /**
     * Show the Subscription Plan Features
     * @param SubscriptionPlan $subscription_plan
     * @return mixed
     */
    public function showFeaturesOrder(SubscriptionPlan $subscription_plan)
    {
        $html = $this->getFeaturesListOrderHtml($subscription_plan);

        return $this->view('settings.subscription_plans.features_order')
            ->with('itemsHtml', $html);
    }

    /**
     * Update the list order for the features
     * @param SubscriptionPlan $subscription_plan
     * @param Request          $request
     * @return array
     */
    public function updateFeaturesOrder(SubscriptionPlan $subscription_plan, Request $request)
    {
        $items = json_decode($request->get('list'), true);
        $features = [];
        foreach ($items as $key => $item) {
            $features[$item['id']] = ['list_order' => ($key + 1)];
        }

        $subscription_plan->features()->syncWithoutDetaching($features);

        return ['result' => 'success'];
    }

    /**
     * Generate the nestable html
     *
     * @param SubscriptionPlan $subscription_plan
     * @return string
     * @internal param null $parent
     *
     */
    private function getFeaturesListOrderHtml(SubscriptionPlan $subscription_plan)
    {
        $html = '<ol class="dd-list">';

        $items = $subscription_plan->features;
        foreach ($items as $key => $item) {
            $html .= '<li class="dd-item" data-id="' . $item->id . '">';
            $html .= '<div class="dd-handle">' . $item->title . '</div>';
            $html .= '</li>';
        }
        $html .= '</ol>';

        return (count($items) >= 1 ? $html : '');
    }
}
