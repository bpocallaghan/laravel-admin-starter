<?php

namespace App\Http\Controllers\Admin\Geography;

use App\Models\Country;
use App\Http\Requests;

use Redirect;
use Titan\Controllers\TitanAdminController;

use Illuminate\Http\Request;

class CountriesController extends TitanAdminController
{
    /**
     * Display a listing of countries.
     *
     * @return Response
     */
    public function index()
    {
        return $this->view('geography.countries.index')->with('items', Country::all());
    }

    /**
     * Show the form for creating a new country.
     *
     * @return Response
     */
    public function create()
    {
        return $this->view('geography.countries.add_edit');
    }

    /**
     * Store a newly created country in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Country::$rules, Country::$messages);

        $this->createEntry(Country::class, $request->except('files'));

        return route_admin('geography.countries.index');
    }

    /**
     * Display the specified country.
     *
     * @param Country $countries
     * @return Response
     */
    public function show(Country $countries)
    {
        return $this->view('geography.countries.show')->with('item', $countries);
    }

    /**
     * Show the form for editing the specified country.
     *
     * @param Country $countries
     * @return Response
     */
    public function edit(Country $countries)
    {
        return $this->view('geography.countries.add_edit')->with('item', $countries);
    }

    /**
     * Update the specified country in storage.
     *
     * @param Country $countries
     * @param Request $request
     * @return Response
     */
    public function update(Country $countries, Request $request)
    {
        $this->validate($request, Country::$rules, Country::$messages);

        $this->updateEntry($countries, $request->except('files'));

        return route_admin('geography.countries.index');
    }

    /**
     * Remove the specified country from storage.
     *
     * @param Country $countries
     * @param Request $request
     * @return Response
     */
    public function destroy(Country $countries, Request $request)
    {
        $this->deleteEntry($countries, $request);

        return route_admin('geography.countries.index');
    }
}