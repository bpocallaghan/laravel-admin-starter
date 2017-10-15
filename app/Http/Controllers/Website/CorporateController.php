<?php

namespace App\Http\Controllers\Website;

use App\Models\AnnualReport;
use App\Models\Tender;
use App\Models\Vacancy;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CorporateController extends WebsiteController
{
    public function tenders()
    {
        $items = Tender::active()->orderBy('active_to')->get();

        return $this->view('corporate.tenders')->with('items', $items);
    }

    public function downloadTender(Tender $tender)
    {
        $tender->increment('total_downloads');

        return json_response();
    }

    public function vacancies()
    {
        $items = Vacancy::active()->orderBy('active_to')->get();

        return $this->view('corporate.vacancies')->with('items', $items);
    }

    public function downloadVacancy(Vacancy $vacancy)
    {
        $vacancy->increment('total_downloads');

        return json_response();
    }

    public function annualReports()
    {
        $items = AnnualReport::active()->orderBy('active_to')->get();

        return $this->view('corporate.annual_reports')->with('items', $items);
    }

    public function downloadAnnualReport(AnnualReport $annual_report)
    {
        $annual_report->increment('total_downloads');

        return json_response();
    }
}