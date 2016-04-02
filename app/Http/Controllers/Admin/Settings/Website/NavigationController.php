<?php

namespace App\Http\Controllers\Admin\Settings\Website;

use App\Http\Requests;
use App\Models\Banner;
use App\Models\NavigationWebsite;

use Redirect;
use Titan\Controllers\TitanAdminController;

use Illuminate\Http\Request;

class NavigationController extends TitanAdminController
{
    /**
     * Display a listing of navigations.
     *
     * @return Response
     */
    public function index()
    {
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
        $banners = Banner::getAllLists();
        $parents = NavigationWebsite::getAllLists();

        return $this->view('settings.website.navigations.add_edit', compact('parents', 'banners'));
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

        $inputs = $request->except('banners');
        $inputs['is_main'] = boolval($request->has('is_main'));
        $inputs['is_hidden'] = boolval($request->has('is_hidden'));
        $inputs['is_footer'] = boolval($request->has('is_footer'));
        $inputs['url_parent_id'] = ($inputs['url_parent_id'] == 0 ? $inputs['parent_id'] : $inputs['url_parent_id']);

        $navigation = $this->createEntry(NavigationWebsite::class, $inputs);

        if ($navigation) {
            $navigation->updateUrl()->save();
            $navigation->banners()->attach(input('banners', []));
        }

        return Redirect::route('admin.settings.website.navigation.index');
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
        $banners = Banner::getAllLists();
        $parents = NavigationWebsite::getAllLists();

        return $this->view('settings.website.navigations.add_edit',
            compact('item', 'parents', 'banners'));
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

        $inputs = $request->except('banners');
        $inputs['is_main'] = boolval($request->has('is_main'));
        $inputs['is_hidden'] = boolval($request->has('is_hidden'));
        $inputs['is_footer'] = boolval($request->has('is_footer'));

        $navigation = $this->updateEntry($navigation, $inputs);
        $navigation->updateUrl()->save();

        $navigation->banners()->sync(input('banners', []));

        return Redirect::route('admin.settings.website.navigation.index');
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

        return Redirect::route('admin.settings.website.navigation.index');
    }
}