<?php

namespace App\Http\Controllers\Api;

use LaravelAnalytics;
use App\Http\Requests;
use Titan\Controllers\Traits\AnalyticsHelper;

class AnalyticsController extends ApiController
{
    use AnalyticsHelper;

    /**
     * Get the sessions grouped by country
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVisitorsLocations()
    {
        $dates = $this->getStartEndDate();

        $data = LaravelAnalytics::performQuery($dates['start'], $dates['end'], 'ga:sessions', [
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