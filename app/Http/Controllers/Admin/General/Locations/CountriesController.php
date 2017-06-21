<?php

namespace App\Http\Controllers\Admin\Locations;

use Redirect;
use App\Http\Requests;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class CountriesController extends AdminController
{
	/**
	 * Display a listing of country.
	 *
	 * @return Response
	 */
	public function index()
	{
		save_resource_url();

		return $this->view('locations.countries.index')->with('items', Country::all());
	}

	/**
	 * Show the form for creating a new country.
	 *
	 * @return Response
	 */
	public function create()
	{
		return $this->view('locations.countries.add_edit');
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

        $this->createEntry(Country::class, $request->all());

        return redirect_to_resource();
	}

	/**
	 * Display the specified country.
	 *
	 * @param Country $country
	 * @return Response
	 */
	public function show(Country $country)
	{
		return $this->view('locations.countries.show')->with('item', $country);
	}

	/**
	 * Show the form for editing the specified country.
	 *
	 * @param Country $country
     * @return Response
     */
    public function edit(Country $country)
	{
		return $this->view('locations.countries.add_edit')->with('item', $country);
	}

	/**
	 * Update the specified country in storage.
	 *
	 * @param Country  $country
     * @param Request    $request
     * @return Response
     */
    public function update(Country $country, Request $request)
	{
		$this->validate($request, Country::$rules, Country::$messages);

        $this->updateEntry($country, $request->all());

        return redirect_to_resource();
	}

	/**
	 * Remove the specified country from storage.
	 *
	 * @param Country  $country
     * @param Request    $request
	 * @return Response
	 */
	public function destroy(Country $country, Request $request)
	{
		$this->deleteEntry($country, $request);

        return redirect_to_resource();
	}
}
