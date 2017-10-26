<style>
    .small-box h3, .small-box p {
        z-index: 9999999999;
    }

    .small-charts {
        width: 120px !important;
        height: 85px;
    }

    .small-box .icon-chart {
        position: absolute;
        top: 8px;
        right: 0px;
        z-index: 0;
    }
</style>

<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3 id="visitors">&nbsp;</h3>
                <p>Visitors this Month</p>

                <div class="icon-chart">
                    <canvas class="small-charts" id="chart-visitors"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
            <div class="inner">
                <h3 id="unique-visitors">&nbsp;</h3>
                <p>Unique Visitors this Month</p>

                <div class="icon-chart">
                    <canvas class="small-charts" id="chart-unique-visitors"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-purple">
            <div class="inner">
                <h3 id="bounce-rate">&nbsp;</h3>
                <p>Bounce Rate this Month</p>

                <div class="icon-chart">
                    <canvas class="small-charts" id="chart-bounce-rate"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3 id="page-load">&nbsp;</h3>
                <p>Avg Page Load</p>
            </div>
            <div class="icon">
                <i class="ion ion-speedometer"></i>
            </div>
        </div>
    </div>

    @if(isset($activeUsers))
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3 id="page-active-visitors">&nbsp;</h3>
                    <p>Current Active Visitors</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
            </div>
        </div>
    @endif
</div>

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function () {
            function getMonthlySummary()
            {
                doAjax('/api/analytics/visitors', null, function (response) {
                    $('#visitors').html(response.data['month']['value']);
                    doughnutChart('chart-visitors', response.data);
                });

                doAjax('/api/analytics/unique-visitors', null, function (response) {
                    $('#unique-visitors').html(response.data['month']['value']);
                    doughnutChart('chart-unique-visitors', response.data);
                });

                doAjax('/api/analytics/bounce-rate', null, function (response) {
                    response.data['month']['value'] = parseFloat(response.data['month']['value']).toFixed(2);
                    response.data['last_month']['value'] = parseFloat(response.data['last_month']['value']).toFixed(2);
                    $('#bounce-rate').html(response.data['month']['value'] + '<sup style="font-size: 20px">%</sup>');
                    doughnutChart('chart-bounce-rate', response.data);
                });

                doAjax('/api/analytics/page-load', null, function (response) {
                    $('#page-load').html(parseFloat(response.data).toFixed(0) + '<sup style="font-size: 20px">sec</sup>');
                });

                doAjax('/api/analytics/active-visitors', null, function (response) {
                    $('#page-active-visitors').html(parseFloat(response.data).toFixed(0));
                });
            }

            function doughnutChart(id, data)
            {
                // total page views and visitors line chart
                var ctx = document.getElementById(id).getContext("2d");

                var chart = new Chart(ctx).Doughnut(data, {});
            }

            getMonthlySummary();
        })
    </script>
@endsection