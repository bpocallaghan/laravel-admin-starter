<div class="loading-widget text-primary">
    <i class="fa fa-fw fa-spinner fa-spin"></i>
</div>

<div class="chart-legend"></div>

<canvas class="line-chart"></canvas>

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        var datatable;
        $(function ()
        {
            var chart;

            initToolbarDateRange('#{{ $id }} .daterange', updateChart);

            /**
             * Get the chart's data
             * @param view
             */
            function updateChart(start, end)
            {
                if (chart) {
                    chart.destroy();
                }

                if (datatable) {
                    datatable.destroy();
                }

                if (!start) {
                    start = moment().subtract(29, 'days').format('YYYY-MM-DD');
                    end = moment().format('YYYY-MM-DD');
                }

                $('#{{ $id }} .loading-widget').show();

                doAjax("{{ isset($url)? $url : request()->url() . '/chart' }}", {
                    'date_from': start, 'date_to': end,
                }, createLineChart);

                // if there is an update function in parent to notify about date change
                if (typeof onUpdate != 'undefined' && isFunction(onUpdate)) {
                    onUpdate(start, end);
                }
            }

            function createLineChart(data)
            {
                // total page views and visitors line chart
                var ctx = document.getElementById("{{ $id }}").getElementsByClassName("line-chart")[0].getContext("2d");

                chart = new Chart(ctx).Line(data, {
                    //tooltipTemplate: "<%= value %> - <%= datasetLabel %>",
                    multiTooltipTemplate: "<%= value %> - <%= datasetLabel %>"
                });

                $('#{{ $id }} .loading-widget').slideUp();

                @if(isset($legend) && $legend == true || !isset($legend))
                    $('#{{ $id }} .chart-legend').html(chart.generateLegend());
                @endif
            }

            setTimeout(function ()
            {
                updateChart();
            }, 300);
        })
    </script>
@endsection