<div class="box box-primary" id="box-geo-visitors" style="min-height: 400px;">
    <div class="box-header with-border">
        <h3 class="box-title">
            <span><i class="fa fa-globe"></i></span>
            <span>Visitors</span>
        </h3>

        @include('admin.partials.boxes.toolbar')
    </div>

    <div class="box-body">
        <div class="loading-widget text-primary">
            <i class="fa fa-fw fa-spinner fa-spin"></i>
        </div>

        <div id="js-geo-visitors-chart"></div>
    </div>
</div>

@section('scripts')
    @parent
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" charset="utf-8">
        $(function () {
            google.charts.load('current', {
                'packages': ['geochart'],
                'mapsApiKey': "{{ config('app.google_map_key') }}"
            });
            // on callback - get chart info chart
            google.charts.setOnLoadCallback(updateChart);

            var chart;

            initToolbarDateRange('#box-geo-visitors .daterange', updateChart);

            /**
             * Get the chart's data
             * @param view
             */
            function updateChart(start, end)
            {
                if (chart) {
                    chart.clearChart();
                }

                if (!start) {
                    start = moment().subtract(29, 'days').format('YYYY-MM-DD');
                    end = moment().format('YYYY-MM-DD');
                }

                $('#box-geo-visitors .loading-widget').show();
                doAjax('/api/analytics/visitors/locations', {
                    'start': start, 'end': end,
                }, createVisitorsLocations);
            }

            function createVisitorsLocations(response)
            {
                $('#box-geo-visitors .loading-widget').slideUp();

                var items = response.data;
                items.unshift(['Country', 'Sessions']);

                var data = google.visualization.arrayToDataTable(items);
                chart = new google.visualization.GeoChart(document.getElementById('js-geo-visitors-chart'));
                chart.draw(data, {
                    colorAxis: {minValue: 0,  colors: ['#b2dcf5', '#06517b']}
                });
            }
        })
    </script>
@endsection