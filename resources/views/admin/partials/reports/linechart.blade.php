<div class="loading-widget text-primary" style="top: 20%;">
    <i class="fa fa-fw fa-spinner fa-spin"></i>
</div>

<div id="main-chart-legend" class="chart-legend"></div>

<canvas id="main-chart"></canvas>

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        var datatable;
        $(function ()
        {
            var chart;

            initToolbarDateRange('#box-main-chart .daterange', updateChart);

            /**
             * Get the chart's data
             * @param view
             */
            function updateChart(start, end)
            {
                if (chart) { chart.destroy(); }
                if (datatable) { datatable.destroy(); }

                if (!start) {
                    start = moment().subtract(29, 'days').format('YYYY-MM-DD');
                    end = moment().format('YYYY-MM-DD');
                }

                $('#box-main-chart .loading-widget').show();

                doAjax("{{ Request::url() }}" + '/chart', {
                    'date_from': start, 'date_to': end,
                }, createLineChart);

                if(onUpdate && isFunction(onUpdate))
                {
                    onUpdate(start, end);
                }
            }

            function createLineChart(data)
            {
                // total page views and visitors line chart
                var ctx = document.getElementById("main-chart").getContext("2d");

                chart = new Chart(ctx).Line(data, {
                    tooltipTemplate: "<%= value %> - <%= datasetLabel %>",
                    multiTooltipTemplate: "<%= value %> - <%= datasetLabel %>"
                });

                 $('#box-main-chart .loading-widget').slideUp();

                $('#main-chart').html(chart.generateLegend());
            }

            setTimeout(function ()
            {
                updateChart();
            }, 300);
        })
    </script>
@endsection