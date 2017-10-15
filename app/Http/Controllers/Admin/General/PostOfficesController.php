<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Suburb;
use Redirect;
use App\Http\Requests;
use App\Models\PostOffice;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class PostOfficesController extends AdminController
{
    /**
     * Display a listing of post_office.
     *
     * @return Response
     */
    public function index()
    {
        save_resource_url();

        return $this->view('post_offices.index')->with('items', PostOffice::all());
    }

    /**
     * Show the form for creating a new post_office.
     *
     * @return Response
     */
    public function create()
    {
        $cities = City::getAllLists();
        $suburbs = Suburb::getAllLists();

        return $this->view('post_offices.create_edit')
            ->with('cities', $cities)
            ->with('suburbs', $suburbs);
    }

    /**
     * Store a newly created post_office in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate(PostOffice::$rules, PostOffice::$messages);

        $post_office = $this->createEntry(PostOffice::class, $attributes);

        log_activity('PostOffice Created', 'A PostOffice was successfully created', $post_office);

        return redirect_to_resource();
    }

    /**
     * Display the specified post_office.
     *
     * @param PostOffice $post_office
     * @return Response
     */
    public function show(PostOffice $post_office)
    {
        return $this->view('post_offices.show')->with('item', $post_office);
    }

    /**
     * Show the form for editing the specified post_office.
     *
     * @param PostOffice $post_office
     * @return Response
     */
    public function edit(PostOffice $post_office)
    {
        $cities = City::getAllLists();
        $suburbs = Suburb::getAllLists();

        return $this->view('post_offices.create_edit')
            ->with('item', $post_office)
            ->with('cities', $cities)
            ->with('suburbs', $suburbs);
    }

    /**
     * Update the specified post_office in storage.
     *
     * @param PostOffice $post_office
     * @param Request    $request
     * @return Response
     */
    public function update(PostOffice $post_office, Request $request)
    {
        $attributes = request()->validate(PostOffice::$rules, PostOffice::$messages);

        $post_office = $this->updateEntry($post_office, $attributes);

        log_activity('PostOffice Updated', 'A PostOffice was successfully updated', $post_office);

        return redirect_to_resource();
    }

    /**
     * Remove the specified post_office from storage.
     *
     * @param PostOffice $post_office
     * @param Request    $request
     * @return Response
     */
    public function destroy(PostOffice $post_office, Request $request)
    {
        $this->deleteEntry($post_office, $request);

        log_activity('PostOffice Deleted', 'A PostOffice was successfully deleted', $post_office);

        return redirect_to_resource();
    }
}
