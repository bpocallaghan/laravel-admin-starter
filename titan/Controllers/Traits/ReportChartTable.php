<?php

namespace Titan\Controllers\Traits;

use Carbon\Carbon;
use Illuminate\Http\Request;

trait ReportChartTable
{
    // http://www.colorhexa.com
    protected $datasets = [
        [ // BLUE
            'label'                => "",
            'fillColor'            => "rgba(60, 141, 188, 0.1)",
            'strokeColor'          => "rgba(60, 141, 188, 1)",
            'pointColor'           => "#3b8bba",
            'pointStrokeColor'     => "rgba(60,141,188,1)",
            'pointHighlightFill'   => "#fff",
            'pointHighlightStroke' => "rgb(100, 100, 100)",
            'data'                 => [],
        ],
        [ // GREEN
            'label'                => "",
            'fillColor'            => "rgba(0, 141, 76, 0.1)",
            'strokeColor'          => "rgba(0, 141, 76, 1)",
            'pointColor'           => "rgba(0, 141, 76, 1)",
            'pointStrokeColor'     => "#fff",
            'pointHighlightFill'   => "#fff",
            'pointHighlightStroke' => "rgb(100, 100, 100)",
            'data'                 => [],
        ],
        [ // BRONZE - BROWN
            'label'                => "",
            'fillColor'            => "rgba(185, 114, 45, 0.1)",
            'strokeColor'          => "rgba(185, 114, 45, 1)",
            'pointColor'           => "rgba(185, 114, 45, 1)",
            'pointStrokeColor'     => "#fff",
            'pointHighlightFill'   => "#fff",
            'pointHighlightStroke' => "rgb(100, 100, 100)",
            'data'                 => [],
        ],
        [ // SILVER - GREY
            'label'                => "",
            'fillColor'            => "rgba(192, 192, 192, 0.1)",
            'strokeColor'          => "rgba(192, 192, 192, 1)",
            'pointColor'           => "rgba(192, 192, 192, 1)",
            'pointStrokeColor'     => "#fff",
            'pointHighlightFill'   => "#fff",
            'pointHighlightStroke' => "rgb(100, 100, 100)",
            'data'                 => [],
        ],
        [ // GOLD - YELLOW
            'label'                => "",
            'fillColor'            => "rgba(255, 200, 0, 0.1)",
            'strokeColor'          => "rgba(255, 200, 0, 1)",
            'pointColor'           => "rgba(255, 200, 0, 1)",
            'pointStrokeColor'     => "#fff",
            'pointHighlightFill'   => "#fff",
            'pointHighlightStroke' => "rgb(100, 100, 100)",
            'data'                 => [],
        ],
    ];

    private function inputDateFrom()
    {
        return input('date_from', Carbon::now()->subWeeks(4)->format('Y-m-d'));
    }

    private function inputDateTo()
    {
        return input('date_to', Carbon::now()->format('Y-m-d'));
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
}