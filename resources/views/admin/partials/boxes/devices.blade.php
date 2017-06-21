<div class="box box-primary" id="box-devices" style="min-height: 400px;">
    <div class="box-header with-border">
        <h3 class="box-title">
            <span><i class="fa fa-mobile"></i></span>
            <span>Top Devices</span>
        </h3>

        @include('admin.partials.boxes.toolbar')
    </div>

    <div class="box-body">
        <div class="loading-widget text-primary">
            <i class="fa fa-fw fa-spinner fa-spin"></i>
        </div>

        <table id="tbl-devices" data-order-by="1|desc" class="table nowrap table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Device</th>
                <th>Sessions</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
            var datatable;

            initToolbarDateRange('#box-devices .daterange', updateDevices);

            function updateDevices(start, end)
            {
                $('#box-devices .loading-widget').show();

                if (datatable) {
                    datatable.destroy();
                    $('#box-devices table tbody').html('')
                }

                if (!start) {
                    start = moment().subtract(29, 'days').format('YYYY-MM-DD');
                    end = moment().format('YYYY-MM-DD');
                }

                doAjax('/api/analytics/devices', {
                    'start': start, 'end': end,
                }, renderTableDevices);
            }

            function renderTableDevices(data)
            {
                $('#box-devices .loading-widget').slideUp();

                for (var i = 0; i < data.length; i++) {
                    var html = '<tr><td>' + data[i][0] + '</td><td>' + data[i][1] + '</td></tr>';
                    $('#box-devices table tbody').append(html);
                }

                datatable = initDataTables('#tbl-devices');
            }

            setTimeout(function ()
            {
                updateDevices();
            }, 300);
        })
    </script>
@endsection