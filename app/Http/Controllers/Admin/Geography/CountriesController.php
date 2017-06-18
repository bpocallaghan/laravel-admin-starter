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
        session()->put('url', request()->url());

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

        return redirect(session('url'));
    }

    /**
     * Display the specified country.
     *
     * @param Country $country
     * @return Response
     */
    public function show(Country $country)
    {
        return $this->view('geography.countries.show')->with('item', $country);
    }

    /**
     * Show the form for editing the specified country.
     *
     * @param Country $country
     * @return Response
     */
    public function edit(Country $country)
    {
        return $this->view('geography.countries.add_edit')->with('item', $country);
    }

    /**
     * Update the specified country in storage.
     *
     * @param Country $country
     * @param Request $request
     * @return Response
     */
    public function update(Country $country, Request $request)
    {
        $this->validate($request, Country::$rules, Country::$messages);

        $this->updateEntry($country, $request->except('files'));

        return redirect(session('url'));
    }

    /**
     * Remove the specified country from storage.
     *
     * @param Country $country
     * @param Request $request
     * @return Response
     */
    public function destroy(Country $country, Request $request)
    {
        $this->deleteEntry($country, $request);

        return redirect(session('url'));
    }
}