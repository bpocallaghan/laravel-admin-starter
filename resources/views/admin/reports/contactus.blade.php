@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary" id="box-main-chart">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-comment-o"></i></span>
                        <span>Contact Us</span>
                    </h3>

                    @include('admin.partials.boxes.toolbar')
                </div>

                <div class="box-body">

                    @include('admin.partials.charts.linechart', [
                        'id' => 'box-main-chart',
                    ])

                    <hr/>

                    <table data-order-by="4|desc" id="main-datatable" class="table table-striped table-bordered" width="100%">
                        <thead>
                        <tr>
                            <th>Fullname</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Content</th>
                            <th>Created On</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        function onUpdate(start, end)
        {
            datatable = initDatatablesAjax('#main-datatable', "{{ request()->url() }}" + "/datatable?date_from=" + start + '&date_to=' + end, [
                {data: 'fullname', name: 'fullname'},
                {data: 'phone', name: 'phone'},
                {data: 'email', name: 'email'},
                {data: 'content', name: 'content'},
                {data: 'date', name: 'date'},
            ]);
        }
    </script>
@endsection
