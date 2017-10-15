<?php

namespace App\Http\Controllers\Admin\Corporate;

use Redirect;
use App\Http\Requests;
use App\Models\AnnualReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class AnnualReportsController extends AdminController
{
	/**
	 * Display a listing of annual_report.
	 *
	 * @return Response
	 */
	public function index()
	{
		save_resource_url();

		return $this->view('corporate.annual_reports.index')->with('items', AnnualReport::all());
	}

	/**
	 * Show the form for creating a new annual_report.
	 *
	 * @return Response
	 */
	public function create()
	{
		return $this->view('corporate.annual_reports.create_edit');
	}

	/**
	 * Store a newly created annual_report in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$attributes = request()->validate(AnnualReport::$rules, AnnualReport::$messages);

        // will throw a validation exception
        $filename = $this->moveDocument($attributes);

        $annual_report = $this->createEntry(AnnualReport::class, $attributes);

        // create the document entry
        $annual_report->documents()->create([
            'name'     => $attributes['name'],
            'filename' => $filename,
        ]);

        log_activity('Annual Report Created', 'An Annual Report was successfully created', $annual_report);

        return redirect_to_resource();
	}

	/**
	 * Display the specified annual_report.
	 *
	 * @param AnnualReport $annual_report
	 * @return Response
	 */
	public function show(AnnualReport $annual_report)
	{
		return $this->view('corporate.annual_reports.show')->with('item', $annual_report);
	}

	/**
	 * Show the form for editing the specified annual_report.
	 *
	 * @param AnnualReport $annual_report
     * @return Response
     */
    public function edit(AnnualReport $annual_report)
	{
		return $this->view('corporate.annual_reports.create_edit')->with('item', $annual_report);
	}

	/**
	 * Update the specified annual_report in storage.
	 *
	 * @param AnnualReport  $annual_report
     * @param Request    $request
     * @return Response
     */
    public function update(AnnualReport $annual_report, Request $request)
	{
        if (!is_null(request()->file('file'))) {
            $attributes = request()->validate(AnnualReport::$rules, AnnualReport::$messages);

            // will throw a validation exception
            $filename = $this->moveDocument($attributes);

            // update the document entry
            $annual_report->document->update([
                'name'     => $attributes['name'],
                'filename' => $filename,
            ]);
        }
        else {
            // remove the file from rules
            $attributes = request()->validate(array_except(AnnualReport::$rules, 'file'),
                AnnualReport::$messages);
        }

        $annual_report = $this->updateEntry($annual_report, $attributes);

        log_activity('Annual Report Updated', 'An Annual Report was successfully updated', $annual_report);

        return redirect_to_resource();
	}

	/**
	 * Remove the specified annual_report from storage.
	 *
	 * @param AnnualReport  $annual_report
     * @param Request    $request
	 * @return Response
	 */
	public function destroy(AnnualReport $annual_report, Request $request)
	{
		$this->deleteEntry($annual_report, $request);

		log_activity('Annual Report Deleted', 'An Annual Report was successfully deleted', $annual_report);

        return redirect_to_resource();
	}
}
