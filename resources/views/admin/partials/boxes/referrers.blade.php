<div class="box box-primary" id="box-referrers" style="min-height: 400px;">
    <div class="box-header with-border">
        <h3 class="box-title">
            <span><i class="fa fa-file-text"></i></span>
            <span>Top Refarrals</span>
        </h3>

        @include('admin.partials.boxes.toolbar')
    </div>

    <div class="box-body">
        <div class="loading-widget text-primary">
            <i class="fa fa-fw fa-spinner fa-spin"></i>
        </div>

        <table id="tbl-referrers" data-order-by="1|desc" class="table nowrap table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>URL</th>
                <th>Page Views</th>
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

            initToolbarDateRange('#box-referrers .daterange', updateReferrers);

            function updateReferrers(start, end)
            {
                $('#box-referrers .loading-widget').show();

                if (datatable) {
                    datatable.destroy();
                    $('#box-referrers table tbody').html('')
                }

                if (!start) {
                    start = moment().subtract(29, 'days').format('YYYY-MM-DD');
                    end = moment().format('YYYY-MM-DD');
                }

                doAjax('/api/analytics/referrers', {
                    'start': start, 'end': end,
                }, renderTableReferrers);
            }

            function renderTableReferrers(data)
            {
                $('#box-referrers .loading-widget').slideUp();

                for (var i = 0; i < data.length; i++) {
                    var html = '<tr><td>' + data[i]['url'] + '</td><td>' + data[i]['pageViews'] + '</td></tr>';
                    $('#box-referrers table tbody').append(html);
                }

                datatable = initDataTables('#tbl-referrers');
            }

            setTimeout(function ()
            {
                updateReferrers();
            }, 300);
        })
    </script>
@endsection