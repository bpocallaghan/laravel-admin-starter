<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\FeedbackContactUs;
use Yajra\DataTables\Facades\DataTables;
use Titan\Controllers\TitanAdminController;
use Titan\Controllers\Traits\ReportChartTable;

class ContactUsController extends TitanAdminController
{
    use ReportChartTable;

    /**
     * Return the view
     * @return $this
     */
    public function index()
    {
        return $this->view('reports.contactus');
    }

    /**
     * Return the data formatted for chart
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChartData()
    {
        // get all items between dates
        $rows = FeedbackContactUs::where('created_at', '>=', $this->inputDateFrom() . '%')
            ->where('created_at', '<=', $this->inputDateTo() . '  23:59:59')
            ->orderBy('created_at')
            ->get();

        // collection group by date
        $days = $rows->groupBy(function ($row) {
            return $row->created_at->format('l d F');
        })->all();

        // format and add to response
        $response = ['labels' => [], 'total' => 0];
        $line = [];
        foreach ($days as $date => $items) {
            $response['total'] += $items->count();
            $response['labels'][] = $date;

            $line[] = $items->count();
        }

        $response['datasets'][] = $this->getDataSet('Total', $line);

        return json_encode($response);
    }

    /**
     * Get the data - datatables
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTableData()
    {
        $items = FeedbackContactUs::selectRaw('*, DATE_FORMAT(created_at, "%d %b, %Y ") as date')
            ->where('created_at', '>=', $this->inputDateFrom() . '%')
            ->where('created_at', '<=', $this->inputDateTo() . '  23:59:59')
            ->orderBy('created_at')
            ->get();

        return DataTables::of($items)->addColumn('fullname', function ($row) {
            return $row->fullname;
        })->addColumn('date', function ($row) {
            return $row->created_at->format('d M Y');
        })->make(true);
    }
}