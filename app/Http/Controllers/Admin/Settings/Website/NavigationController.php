<?php

namespace App\Http\Controllers\Admin\Settings\Website;

use Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\NavigationWebsite;
use Titan\Controllers\TitanAdminController;

class NavigationController extends TitanAdminController
{
    /**
     * Display a listing of navigations.
     *
     * @return Response
     */
    public function index()
    {
        save_resource_url();
        $items = NavigationWebsite::all();

        return $this->view('settings.website.navigations.index', compact('items'));
    }

    /**
     * Show the form for creating a new navigation.
     *
     * @return Response
     */
    public function create()
    {
        $parents = NavigationWebsite::getAllLists();

        return $this->view('settings.website.navigations.add_edit', compact('parents'));
    }

    /**
     * Store a newly created navigation in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, NavigationWebsite::$rules, NavigationWebsite::$messages);

        $inputs = $request->all();
        $inputs['is_main'] = boolval($request->has('is_main'));
        $inputs['is_hidden'] = boolval($request->has('is_hidden'));
        $inputs['is_footer'] = boolval($request->has('is_footer'));
        $inputs['url_parent_id'] = ($inputs['url_parent_id'] == 0 ? $inputs['parent_id'] : $inputs['url_parent_id']);

        $navigation = $this->createEntry(NavigationWebsite::class, $inputs);

        if ($navigation) {
            $navigation->updateUrl()->save();
        }

        return redirect_to_resource();
    }

    /**
     * Display the specified navigation.
     *
     * @param $navigation
     * @return Response
     */
    public function show(NavigationWebsite $navigation)
    {
        return $this->view('settings.website.navigations.show')->with('item', $navigation);
    }

    /**
     * Show the form for editing the specified navigation.
     *
     * @param $navigation
     * @return Response
     */
    public function edit(NavigationWebsite $navigation)
    {
        $item = $navigation;
        $parents = NavigationWebsite::getAllLists();

        return $this->view('settings.website.navigations.add_edit', compact('item', 'parents'));
    }

    /**
     * Update the specified NavigationWebsite in storage.
     *
     * @param         $navigation
     * @param Request $request
     * @return Response
     */
    public function update(NavigationWebsite $navigation, Request $request)
    {
        $this->validate($request, NavigationWebsite::$rules, NavigationWebsite::$messages);

        $inputs = $request->all();
        $inputs['is_main'] = boolval($request->has('is_main'));
        $inputs['is_hidden'] = boolval($request->has('is_hidden'));
        $inputs['is_footer'] = boolval($request->has('is_footer'));

        $navigation = $this->updateEntry($navigation, $inputs);
        $navigation->updateUrl()->save();

        return redirect_to_resource();
    }

    /**
     * Remove the specified navigation from storage.
     *
     * @param         $navigation
     * @param Request $request
     * @return Response
     */
    public function destroy(NavigationWebsite $navigation, Request $request)
    {
        $this->deleteEntry($navigation, $request);

        return redirect_to_resource();
    }
}