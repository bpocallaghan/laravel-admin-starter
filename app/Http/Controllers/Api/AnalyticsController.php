<?php

namespace App\Http\Controllers\Api;

use Analytics;
use App\Http\Requests;
use Titan\Controllers\Traits\GoogleAnalyticsHelper;

class AnalyticsController extends ApiController
{
    use GoogleAnalyticsHelper;

    /**
     * Get the sessions grouped by country
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVisitorsLocations()
    {
        $period = $this->analyticsDuration();

        $data = Analytics::performQuery($period, 'ga:sessions', [
            'dimensions'  => 'ga:country',
            'sort'        => '-ga:sessions',
            'max-results' => 50
        ]);

        $items = [];
        if ($data->rows) {
            $items = $data->rows;
        }

        foreach ($items as $k => $item) {
            $items[$k][1] = intval($items[$k][1]);
        }

        return json_response($items);
    }
}