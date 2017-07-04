@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-table"></i></span>
                        <span>List Admin Actions</span>
                    </h3>

                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-default btn-sm" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="box-body">
                    <table id="tbl-list-activities" data-order-by="0|desc" data-server="false" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>After</th>
                            <th>Before</th>
                            <th>Created</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($activities as $activity)
                            <tr>
                                <td>{{ $activity->id }}</td>
                                <td>{{ isset($activity->user)? $activity->user->fullname:'System' }}</td>
                                <td>{!! $activity->name !!}</td>
                                <td>{!! activitiy_after($activity) !!}</td>
                                <td>{!! $activity->before !!}</td>
                                {{--<td>{{ isset($activity->subject)? isset($activity->subject->title)? $activity->subject->title:'':'' }}</td>--}}
                                <td>{{ $activity->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
            initDataTables('#tbl-list-activities', {
                'pageLength': 25,
                'columnDefs': [
                    {
                        "targets": [0],
                        "visible": false,
                        "searchable": false
                    },
                ]
            });
        })
    </script>
@endsection