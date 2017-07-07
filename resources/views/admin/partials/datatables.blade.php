@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
            // check if we need to get data from server
            if ($("{{ (isset($id)? $id: '#tbl-list') }}").attr('data-server') == 'true') {
                var options = {!! json_encode($options) !!}; // convert php array to js array
                @if(isset($action) && $action == true || isset($action) == false)
                        options.push({
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        visible: true
                    }); // add actions column
                @endif
                var table = initDatatablesAjax("{{ (isset($id)? $id: '#tbl-list') }}", "{{ (isset($url)? $url: request()->url().'/datatable') }}", options, "{{ (isset($displayLength)? $displayLength: 10) }}"); // init datatables
            }
        })
    </script>
@endsection