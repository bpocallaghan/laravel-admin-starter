<?php

namespace Titan\Controllers\Traits;

use Carbon\Carbon;
use Illuminate\Http\Request;
use LaravelAnalytics;

/**
 * https://github.com/spatie/laravel-analytics
 * http://www.colorhexa.com
 *
 * Class Analytics
 * @package Titan\Controllers\Traits
 */
trait Analytics
{
    protected $datasets = [
        [
            'label'                => "",
            'fillColor'            => "rgba(60, 141, 188, 0.1)",
            'strokeColor'          => "rgba(60, 141, 188, 1)",
            'pointColor'           => "#3b8bba",
            'pointStrokeColor'     => "rgba(60,141,188,1)",
            'pointHighlightFill'   => "#fff",
            'pointHighlightStroke' => "rgba(220, 220, 220, 1)",
            'data'                 => [],
        ],
        [
            'label'                => "",
            'fillColor'            => "rgba(0, 141, 76, 0.1)",
            'strokeColor'          => "rgba(0, 141, 76, 1)",
            'pointColor'           => "rgba(0, 141, 76, 1)",
            'pointStrokeColor'     => "#fff",
            'pointHighlightFill'   => "#fff",
            'pointHighlightStroke' => "rgba(220, 220, 220, 1)",
            'data'                 => [],
        ]
    ];

    protected $pieData = [
        [
            'color'     => "#dd4b39",
            'highlight' => "#e15f4f",
        ],
        [
            'color'     => "#00a65a",
            'highlight' => "#00c068",
        ],
        [
            'color'     => "#f39c12",
            'highlight' => "#f4a62a",
        ],
        [
            'color'     => "#00c0ef",
            'highlight' => "#09cfff",
        ],
        [
            'color'     => "#ff2e9f",
            'highlight' => "#ff3434",
        ],
        [
            'color'     => "#307095",
            'highlight' => "#367ea8",
        ],
        [
            'color'     => "#d2d6de",
            'highlight' => "#c3c9d3",
        ],
    ];

    /**
     * Get this months Visitors
     * @return \Illuminate\Http\JsonResponse|int
     */
    public function getVisitors()
    {
        return $this->monthlySummary('ga:users');
    }

    /**
     * Get this months Unique Visitors
     * @return int|string
     */
    public function getUniqueVisitors()
    {
        return $this->monthlySummary('ga:newUsers');
    }

    /**
     * Get this months Visitors
     * @return \Illuminate\Http\JsonResponse|int
     */
    public function getBounceRate()
    {
        return $this->monthlySummary('ga:bounceRate');
    }

    /**
     * Get this months average page load time
     * @return \Illuminate\Http\JsonResponse|int
     */
    public function getAvgPageLoad()
    {
        return $this->monthlySummary('ga:avgPageLoadTime');
    }

    /**
     * Get the top keywords for duration
     * @return \Spatie\LaravelAnalytics\Collection
     */
    public function getKeywords()
    {
        $dates = $this->getStartEndDate();

        $items = LaravelAnalytics::getTopKeyWordsForPeriod($dates['start'],
            $dates['end']);

        return $items;
    }

    /**
     * Get the visitors and page views for duration
     * Format result for CartJS
     * @return string
     */
    public function getVisitorsAndPageViews()
    {
        $dates = $this->getStartEndDate();

        $data = LaravelAnalytics::getVisitorsAndPageViewsForPeriod($dates['start'],
            $dates['end']);

        $totalViews = ['labels' => []];
        $visitors = [];
        $pageviews = [];
        foreach ($data as $k => $item) {
            array_push($totalViews['labels'], $item['date']->format('d M'));

            array_push($visitors, $item['visitors']);
            array_push($pageviews, $item['pageViews']);
        }

        $totalViews['datasets'][] = $this->getDataSet('Page Views', $pageviews, 0);
        $totalViews['datasets'][] = $this->getDataSet('Visitors', $visitors, 1);

        return json_encode($totalViews);
    }

    /**
     * Get the most visited pages for duration
     * @return \Spatie\LaravelAnalytics\Collection
     */
    public function getVisitedPages()
    {
        $dates = $this->getStartEndDate();

        $items = LaravelAnalytics::getMostVisitedPagesForPeriod($dates['start'],
            $dates['end']);

        return $items;
    }

    /**
     * Get the top browsers for duration
     * Format results for pie chart
     * @return \Spatie\LaravelAnalytics\Collection
     */
    public function getBrowsers()
    {
        $dates = $this->getStartEndDate();

        $data = LaravelAnalytics::getTopBrowsersForPeriod($dates['start'], $dates['end'],
            7)->toArray();

        $items = [];
        shuffle($data); // shuffle results / randomimize chart color sections
        foreach ($data as $k => $item) {
            $items[] = $this->getPieDataSet($item['browser'], $item['sessions'], $k);
        }

        return $items;
    }

    /**
     * Helper to get the months analytics
     * @param string $metrics
     * @return \Illuminate\Http\JsonResponse|int
     */
    private function monthlySummary($metrics = 'ga:users')
    {
        $end = Carbon::now();
        $start = Carbon::now()->startOfMonth();

        $data = LaravelAnalytics::performQuery($start, $end, $metrics);

        if ($data->rows && count($data->rows) >= 1 && count($data->rows[0]) >= 1) {
            return json_response($data->rows[0][0]);
        }

        return 'n/a';
    }

    /**
     * Get the start and end duration
     * @return array
     */
    private function getStartEndDate()
    {
        $start = input('start', date('Y-m-d', strtotime('-29 days')));
        $end = input('end', date('Y-m-d'));

        if (is_string($start)) {
            $start = \DateTime::createFromFormat('Y-m-d', $start);
        }

        if (is_string($end)) {
            $end = \DateTime::createFromFormat('Y-m-d', $end);
        }

        return compact('start', 'end');
    }

    /**
     * Get the line dataset opbject
     * @param     $label
     * @param     $data
     * @param int $index
     * @return mixed
     */
    private function getDataSet($label, $data, $index = 0)
    {
        $set = $this->datasets[$index];
        $set['label'] = $label;
        $set['data'] = $data;

        return $set;
    }

    /**
     * Get the pie chart data
     * @param     $label
     * @param     $data
     * @param int $index
     * @return mixed
     */
    private function getPieDataSet($label, $data, $index = 0)
    {
        $set = $this->pieData[$index];
        $set['label'] = $label;
        $set['value'] = $data;

        return $set;
    }
}