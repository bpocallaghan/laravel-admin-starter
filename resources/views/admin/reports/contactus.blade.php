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

                    <table data-order-by="5|desc" id="main-datatable" class="table table-striped table-bordered" width="100%">
                        <thead>
                        <tr>
                            <th>Category</th>
                            <th>Fullname</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Subject</th>
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
            datatable = initDatatablesAjax('#main-datatable', "{{ Request::url() }}" + "/datatable?date_from=" + start + '&date_to=' + end, [
                {data: 'category', name: 'category'},
                {data: 'fullname', name: 'fullname'},
                {data: 'phone', name: 'phone'},
                {data: 'email', name: 'email'},
                {data: 'subject', name: 'subject'},
                {data: 'content', name: 'content'},
                {data: 'date', name: 'date'},
            ]);
        }
    </script>
@endsection
