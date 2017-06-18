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
        session()->put('url', request()->url());

        return $this->view('geography.cities.index')->with('items', City::with('country')->get());
    }

    /**
     * Show the form for creating a new city.
     *
     * @return Response
     */
    public function create()
    {
        return $this->view('geography.cities.add_edit')->with('countries', Country::getAllLists());
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

        return redirect(session('url'));
    }

    /**
     * Display the specified city.
     *
     * @param City $city
     * @return Response
     */
    public function show(City $city)
    {
        return $this->view('geography.cities.show')->with('item', $city);
    }

    /**
     * Show the form for editing the specified city.
     *
     * @param City $city
     * @return Response
     */
    public function edit(City $city)
    {
        return $this->view('geography.cities.add_edit')
            ->with('item', $city)
            ->with('countries', Country::getAllLists());
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

        $this->updateEntry($city, $request->except('files'));

        return redirect(session('url'));
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

        return redirect(session('url'));
    }
}