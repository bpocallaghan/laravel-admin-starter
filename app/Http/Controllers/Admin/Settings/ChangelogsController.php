<?php

namespace App\Http\Controllers\Admin\Settings;

use Redirect;
use App\Http\Requests;
use App\Models\Changelog;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class ChangelogsController extends AdminController
{
    /**
     * Display a listing of changelog.
     *
     * @return Response
     */
    public function index()
    {
        save_resource_url();

        return $this->view('settings.changelogs.index')->with('items', Changelog::all());
    }

    /**
     * Show the form for creating a new changelog.
     *
     * @return Response
     */
    public function create()
    {
        return $this->view('settings.changelogs.add_edit');
    }

    /**
     * Store a newly created changelog in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Changelog::$rules, Changelog::$messages);

        $changelog = $this->createEntry(Changelog::class, $request->only(['version', 'date_at', 'content']));

        log_activity('Changelog Updated', 'Changelog was updated. ' . $changelog->version);

        return redirect_to_resource();
    }

    /**
     * Display the specified changelog.
     *
     * @param Changelog $changelog
     * @return Response
     */
    public function show(Changelog $changelog)
    {
        return $this->view('settings.changelogs.show')->with('item', $changelog);
    }

    /**
     * Show the form for editing the specified changelog.
     *
     * @param Changelog $changelog
     * @return Response
     */
    public function edit(Changelog $changelog)
    {
        return $this->view('settings.changelogs.add_edit')->with('item', $changelog);
    }

    /**
     * Update the specified changelog in storage.
     *
     * @param Changelog $changelog
     * @param Request   $request
     * @return Response
     */
    public function update(Changelog $changelog, Request $request)
    {
        $this->validate($request, Changelog::$rules, Changelog::$messages);

        $this->updateEntry($changelog, $request->only(['version', 'date_at', 'content']));

        log_activity('Changelog Updated', 'Changelog was updated. ' . $changelog->version);

        return redirect_to_resource();
    }

    /**
     * Remove the specified changelog from storage.
     *
     * @param Changelog $changelog
     * @param Request   $request
     * @return Response
     */
    public function destroy(Changelog $changelog, Request $request)
    {
        $this->deleteEntry($changelog, $request);

        log_activity('Changelog deleted', 'Changelog was deleted.');

        return redirect_to_resource();
    }
}
