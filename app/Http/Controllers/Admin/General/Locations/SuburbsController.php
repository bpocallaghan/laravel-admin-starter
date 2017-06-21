<?php

namespace App\Http\Controllers\Admin\Locations;

use App\Models\City;
use Redirect;
use App\Http\Requests;
use App\Models\Suburb;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class SuburbsController extends AdminController
{
    /**
     * Display a listing of suburb.
     *
     * @return Response
     */
    public function index()
    {
        save_resource_url();

        return $this->view('locations.suburbs.index')->with('items', Suburb::all());
    }

    /**
     * Show the form for creating a new suburb.
     *
     * @return Response
     */
    public function create()
    {
        $cities = City::getAllLists();

        return $this->view('locations.suburbs.add_edit', compact('cities'));
    }

    /**
     * Store a newly created suburb in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Suburb::$rules, Suburb::$messages);

        $this->createEntry(Suburb::class, $request->all());

        return redirect_to_resource();
    }

    /**
     * Display the specified suburb.
     *
     * @param Suburb $suburb
     * @return Response
     */
    public function show(Suburb $suburb)
    {
        return $this->view('locations.suburbs.show')->with('item', $suburb);
    }

    /**
     * Show the form for editing the specified suburb.
     *
     * @param Suburb $suburb
     * @return Response
     */
    public function edit(Suburb $suburb)
    {
        $cities = City::getAllLists();

        return $this->view('locations.suburbs.add_edit', compact('cities'))->with('item', $suburb);
    }

    /**
     * Update the specified suburb in storage.
     *
     * @param Suburb  $suburb
     * @param Request $request
     * @return Response
     */
    public function update(Suburb $suburb, Request $request)
    {
        $this->validate($request, Suburb::$rules, Suburb::$messages);

        $this->updateEntry($suburb, $request->all());

        return redirect_to_resource();
    }

    /**
     * Remove the specified suburb from storage.
     *
     * @param Suburb  $suburb
     * @param Request $request
     * @return Response
     */
    public function destroy(Suburb $suburb, Request $request)
    {
        $this->deleteEntry($suburb, $request);

        return redirect_to_resource();
    }
}
