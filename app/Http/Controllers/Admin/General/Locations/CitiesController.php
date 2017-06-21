<?php

namespace App\Http\Controllers\Admin\Locations;

use App\Models\Province;
use Redirect;
use App\Http\Requests;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class CitiesController extends AdminController
{
    /**
     * Display a listing of city.
     *
     * @return Response
     */
    public function index()
    {
        save_resource_url();

        return $this->view('locations.cities.index')->with('items', City::all());
    }

    /**
     * Show the form for creating a new city.
     *
     * @return Response
     */
    public function create()
    {
        $provinces = Province::getAllLists();

        return $this->view('locations.cities.add_edit', compact('provinces'));
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

        $this->createEntry(City::class, $request->all());

        return redirect_to_resource();
    }

    /**
     * Display the specified city.
     *
     * @param City $city
     * @return Response
     */
    public function show(City $city)
    {
        return $this->view('locations.cities.show')->with('item', $city);
    }

    /**
     * Show the form for editing the specified city.
     *
     * @param City $city
     * @return Response
     */
    public function edit(City $city)
    {
        $provinces = Province::getAllLists();

        return $this->view('locations.cities.add_edit', compact('provinces'))->with('item', $city);
    }

    /**
     * Update the specified city in storage.
     *
     * @param City    $city
     * @param Request $request
     * @return Response
     */
    public function update(City $city, Request $request)
    {
        $this->validate($request, City::$rules, City::$messages);

        $this->updateEntry($city, $request->all());

        return redirect_to_resource();
    }

    /**
     * Remove the specified city from storage.
     *
     * @param City    $city
     * @param Request $request
     * @return Response
     */
    public function destroy(City $city, Request $request)
    {
        $this->deleteEntry($city, $request);

        return redirect_to_resource();
    }
}
