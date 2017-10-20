<div class="box box-primary" id="box-keywords" style="min-height: 400px;">
    <div class="box-header with-border">
        <h3 class="box-title">
            <span><i class="fa fa-file-text"></i></span>
            <span>Top Keywords</span>
        </h3>

        @include('admin.partials.boxes.toolbar')
    </div>

    <div class="box-body">
        <div class="loading-widget text-primary">
            <i class="fa fa-fw fa-spinner fa-spin"></i>
        </div>

        <table id="tbl-keywords" data-order-by="1|desc" class="table nowrap table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Keywords</th>
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

            initToolbarDateRange('#box-keywords .daterange', updateKeywords);

            function updateKeywords(start, end)
            {
                $('#box-keywords .loading-widget').show();

                if (datatable) {
                    datatable.destroy();
                    $('#box-keywords table tbody').html('')
                }

                if (!start) {
                    start = moment().subtract(29, 'days').format('YYYY-MM-DD');
                    end = moment().format('YYYY-MM-DD');
                }

                doAjax('/api/analytics/keywords', {
                    'start': start, 'end': end,
                }, renderTableKeywords);
            }

            function renderTableKeywords(data)
            {
                $('#box-keywords .loading-widget').slideUp();

                for (var i = 0; i < data.length; i++) {
                    var html = '<tr><td>' + data[i]['keyword'] + '</td><td>' + data[i]['sessions'] + '</td></tr>';
                    $('#box-keywords table tbody').append(html);
                }

                datatable = initDataTables('#tbl-keywords');
            }

            setTimeout(function ()
            {
                updateKeywords();
            }, 300);
        })
    </script>
@endsection