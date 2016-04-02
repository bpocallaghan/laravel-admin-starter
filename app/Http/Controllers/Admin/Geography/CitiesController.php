<?php

namespace App\Http\Controllers\Admin\Geography;

use App\Models\City;
use App\Http\Requests;

use App\Models\Country;
use App\Models\Region;
use Redirect;
use Titan\Controllers\TitanAdminController;

use Illuminate\Http\Request;

class CitiesController extends TitanAdminController
{
    /**
     * Display a listing of cities.
     *
     * @return Response
     */
    public function index()
    {
        return $this->view('geography.cities.index')
            ->with('items', City::with('country')->get());
    }

    /**
     * Show the form for creating a new city.
     *
     * @return Response
     */
    public function create()
    {
        return $this->view('geography.cities.add_edit')
            ->with('countries', Country::getAllLists());
    }

    /**
     * Store a newly created city in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, City::$rules, City::$messages);

        $this->createEntry(City::class, $request->except('files'));

        return route_admin('geography.cities.index');
    }

    /**
     * Display the specified city.
     *
     * @param City $cities
     * @return Response
     */
    public function show(City $cities)
    {
        return $this->view('geography.cities.show')->with('item', $cities);
    }

    /**
     * Show the form for editing the specified city.
     *
     * @param City $cities
     * @return Response
     */
    public function edit(City $cities)
    {
        return $this->view('geography.cities.add_edit')
            ->with('item', $cities)
            ->with('countries', Country::getAllLists());
    }

    /**
     * Update the specified city in storage.
     *
     * @param City    $cities
     * @param Request $request
     * @return Response
     */
    public function update(City $cities, Request $request)
    {
        $this->validate($request, City::$rules, City::$messages);

        $this->updateEntry($cities, $request->except('files'));

        return route_admin('geography.cities.index');
    }

    /**
     * Remove the specified city from storage.
     *
     * @param City    $cities
     * @param Request $request
     * @return Response
     */
    public function destroy(City $cities, Request $request)
    {
        $this->deleteEntry($cities, $request);

        return route_admin('geography.cities.index');
    }
}