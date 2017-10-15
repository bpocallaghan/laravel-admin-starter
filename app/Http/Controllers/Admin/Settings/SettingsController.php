<?php

namespace App\Http\Controllers\Admin\Settings;

use Redirect;
use App\Http\Requests;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class SettingsController extends AdminController
{
	/**
	 * Display a listing of setting.
	 *
	 * @return Response
	 */
	public function index()
	{
		save_resource_url();

		return $this->view('settings.settings.index')->with('items', Settings::all());
	}

	/**
	 * Show the form for creating a new setting.
	 *
	 * @return Response
	 */
	public function create()
	{
		return $this->view('settings.settings.create_edit');
	}

	/**
	 * Store a newly created setting in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$attributes = request()->validate(Settings::$rules, Settings::$messages);

        $setting = $this->createEntry(Settings::class, $attributes);

        log_activity('Setting Created', 'A Setting was successfully created', $setting);

        return redirect_to_resource();
	}

	/**
	 * Display the specified setting.
	 *
	 * @param Settings $setting
	 * @return Response
	 */
	public function show(Settings $setting)
	{
		return $this->view('settings.settings.show')->with('item', $setting);
	}

	/**
	 * Show the form for editing the specified setting.
	 *
	 * @param Settings $setting
     * @return Response
     */
    public function edit(Settings $setting)
	{
		return $this->view('settings.settings.create_edit')->with('item', $setting);
	}

	/**
	 * Update the specified setting in storage.
	 *
	 * @param Settings $setting
     * @param Request  $request
     * @return Response
     */
    public function update(Settings $setting, Request $request)
	{
		$attributes = request()->validate(Settings::$rules, Settings::$messages);

        $setting = $this->updateEntry($setting, $attributes);

        log_activity('Setting Updated', 'A Setting was successfully updated', $setting);

        return redirect_to_resource();
	}

	/**
	 * Remove the specified setting from storage.
	 *
	 * @param Settings $setting
     * @param Request  $request
	 * @return Response
	 */
	public function destroy(Settings $setting, Request $request)
	{
		$this->deleteEntry($setting, $request);

		log_activity('Setting Deleted', 'A Setting was successfully deleted', $setting);

        return redirect_to_resource();
	}
}
