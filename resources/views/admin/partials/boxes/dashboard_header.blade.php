<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3 id="visitors">&nbsp;</h3>
                <p>Visitors this Month</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
            <div class="inner">
                <h3 id="unique-visitors">&nbsp;</h3>
                <p>Unique Visitors this Month</p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3 id="bounce-rate">&nbsp;</h3>
                <p>Bounce Rate this Month</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3 id="page-load">&nbsp;</h3>
                <p>Avg Page Load</p>
            </div>
            <div class="icon">
                <i class="ion ion-speedometer"></i>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
            function getMonthlySummary() {
                doAjax('/admin/analytics/visitors', null, function(response) {
                    $('#visitors').html(response.data);
                });

                doAjax('/admin/analytics/unique-visitors', null, function(response) {
                    $('#unique-visitors').html(response.data);
                });

                doAjax('/admin/analytics/bounce-rate', null, function(response) {
                    $('#bounce-rate').html(parseFloat(response.data).toFixed(2) + '<sup style="font-size: 20px">%</sup>');
                });

                doAjax('/admin/analytics/page-load', null, function(response) {
                    $('#page-load').html(parseFloat(response.data).toFixed(0)+ '<sup style="font-size: 20px">sec</sup>');
                });
            }

            getMonthlySummary();
        })
    </script>
@endsection