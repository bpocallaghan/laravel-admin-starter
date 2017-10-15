<?php

namespace App\Http\Controllers\Admin\Corporate;

use Redirect;
use App\Http\Requests;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class VacanciesController extends AdminController
{
    /**
     * Display a listing of vacancy.
     *
     * @return Response
     */
    public function index()
    {
        save_resource_url();

        return $this->view('corporate.vacancies.index')->with('items', Vacancy::all());
    }

    /**
     * Show the form for creating a new vacancy.
     *
     * @return Response
     */
    public function create()
    {
        return $this->view('corporate.vacancies.create_edit');
    }

    /**
     * Store a newly created vacancy in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate(Vacancy::$rules, Vacancy::$messages);

        // will throw a validation exception
        $filename = $this->moveDocument($attributes);

        $vacancy = $this->createEntry(Vacancy::class, $attributes);

        // create the document entry
        $vacancy->documents()->create([
            'name'     => $attributes['name'],
            'filename' => $filename,
        ]);

        log_activity('Vacancy Created', 'A Vacancy was successfully created', $vacancy);

        return redirect_to_resource();
    }

    /**
     * Display the specified vacancy.
     *
     * @param Vacancy $vacancy
     * @return Response
     */
    public function show(Vacancy $vacancy)
    {
        return $this->view('corporate.vacancies.show')->with('item', $vacancy);
    }

    /**
     * Show the form for editing the specified vacancy.
     *
     * @param Vacancy $vacancy
     * @return Response
     */
    public function edit(Vacancy $vacancy)
    {
        return $this->view('corporate.vacancies.create_edit')->with('item', $vacancy);
    }

    /**
     * Update the specified vacancy in storage.
     *
     * @param Vacancy $vacancy
     * @param Request $request
     * @return Response
     */
    public function update(Vacancy $vacancy, Request $request)
    {
        if (!is_null(request()->file('file'))) {
            $attributes = request()->validate(Vacancy::$rules, Vacancy::$messages);

            // will throw a validation exception
            $filename = $this->moveDocument($attributes);

            // update the document entry
            $vacancy->document->update([
                'name'     => $attributes['name'],
                'filename' => $filename,
            ]);
        }
        else {
            // remove the file from rules
            $attributes = request()->validate(array_except(Vacancy::$rules, 'file'),
                Vacancy::$messages);
        }

        $vacancy = $this->updateEntry($vacancy, $attributes);

        log_activity('Vacancy Updated', 'A Vacancy was successfully updated', $vacancy);

        return redirect_to_resource();
    }

    /**
     * Remove the specified vacancy from storage.
     *
     * @param Vacancy $vacancy
     * @param Request $request
     * @return Response
     */
    public function destroy(Vacancy $vacancy, Request $request)
    {
        $this->deleteEntry($vacancy, $request);

        log_activity('Vacancy Deleted', 'A Vacancy was successfully deleted', $vacancy);

        return redirect_to_resource();
    }
}
