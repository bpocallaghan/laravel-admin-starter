<?php

namespace App\Http\Controllers\Admin\Corporate;

use Redirect;
use App\Http\Requests;
use App\Models\Tender;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class TendersController extends AdminController
{
    /**
     * Display a listing of tender.
     *
     * @return Response
     */
    public function index()
    {
        save_resource_url();

        return $this->view('corporate.tenders.index')->with('items', Tender::all());
    }

    /**
     * Show the form for creating a new tender.
     *
     * @return Response
     */
    public function create()
    {
        return $this->view('corporate.tenders.create_edit');
    }

    /**
     * Store a newly created tender in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate(Tender::$rules, Tender::$messages);

        // will throw a validation exception
        $filename = $this->moveDocument($attributes);

        // create the tender
        $tender = $this->createEntry(Tender::class, $attributes);

        // create the document entry
        $tender->documents()->create([
            'name'     => $attributes['name'],
            'filename' => $filename,
        ]);

        log_activity('Tender Created', 'A Tender was successfully created', $tender);

        return redirect_to_resource();
    }

    /**
     * Display the specified tender.
     *
     * @param Tender $tender
     * @return Response
     */
    public function show(Tender $tender)
    {
        return $this->view('corporate.tenders.show')->with('item', $tender);
    }

    /**
     * Show the form for editing the specified tender.
     *
     * @param Tender $tender
     * @return Response
     */
    public function edit(Tender $tender)
    {
        return $this->view('corporate.tenders.create_edit')->with('item', $tender);
    }

    /**
     * Update the specified tender in storage.
     *
     * @param Tender  $tender
     * @param Request $request
     * @return Response
     */
    public function update(Tender $tender, Request $request)
    {
        if (!is_null(request()->file('file'))) {
            $attributes = request()->validate(Tender::$rules, Tender::$messages);

            // will throw a validation exception
            $filename = $this->moveDocument($attributes);

            // update the document entry
            $tender->document->update([
                'name'     => $attributes['name'],
                'filename' => $filename,
            ]);
        }
        else {
            // remove the file from rules
            $attributes = request()->validate(array_except(Tender::$rules, 'file'),
                Tender::$messages);
        }

        // create the tender
        $tender = $this->updateEntry($tender, $attributes);

        log_activity('Tender Updated', 'A Tender was successfully updated', $tender);

        return redirect_to_resource();
    }

    /**
     * Remove the specified tender from storage.
     *
     * @param Tender  $tender
     * @param Request $request
     * @return Response
     */
    public function destroy(Tender $tender, Request $request)
    {
        // delete document
        $tender->document->delete();

        $this->deleteEntry($tender, $request);

        log_activity('Tender Deleted', 'A Tender was successfully deleted', $tender);

        return redirect_to_resource();
    }
}
