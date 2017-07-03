<div class="box box-primary" id="box-interests-affinity" style="min-height: 400px;">
    <div class="box-header with-border">
        <h3 class="box-title">
            <span><i class="fa fa-file-text"></i></span>
            <span>Top Interests Affinity</span>
        </h3>

        @include('admin.partials.boxes.toolbar')
    </div>

    <div class="box-body">
        <div class="loading-widget text-primary">
            <i class="fa fa-fw fa-spinner fa-spin"></i>
        </div>

        <table id="tbl-interests-affinity" data-order-by="1|desc" class="table nowrap table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Category</th>
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

            initToolbarDateRange('#box-interests-affinity .daterange', updateInterestsAffinity);

            function updateInterestsAffinity(start, end)
            {
                $('#box-interests-affinity .loading-widget').show();

                if (datatable) {
                    datatable.destroy();
                    $('#box-interests-affinity table tbody').html('')
                }

                if (!start) {
                    start = moment().subtract(29, 'days').format('YYYY-MM-DD');
                    end = moment().format('YYYY-MM-DD');
                }

                doAjax('/api/analytics/interests-affinity', {
                    'start': start, 'end': end,
                }, renderTableInterestsAffinity);
            }

            function renderTableInterestsAffinity(data)
            {
                $('#box-interests-affinity .loading-widget').slideUp();

                for (var i = 0; i < data.length; i++) {
                    var html = '<tr><td>' + data[i][0] + '</td><td>' + data[i][1] + '</td></tr>';
                    $('#box-interests-affinity table tbody').append(html);
                }

                datatable = initDataTables('#tbl-interests-affinity');
            }

            setTimeout(function ()
            {
                updateInterestsAffinity();
            }, 300);
        })
    </script>
@endsection