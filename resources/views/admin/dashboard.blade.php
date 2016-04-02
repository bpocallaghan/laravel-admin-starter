@extends('layouts.admin')

@section('content')

    @include('admin.partials.boxes.dashboard_header')

    <div class="row">
        <div class="col-xs-8">
            @include('admin.partials.boxes.visitors_views')
        </div>
        <div class="col-xs-4">
            @include('admin.partials.boxes.browsers')
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            @include('admin.partials.boxes.keywords')
        </div>
        <div class="col-xs-6">
            @include('admin.partials.boxes.visited_pages')
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-table"></i></span>
                        <span>List All Activities</span>
                    </h3>

                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-default btn-sm" data-widget="collapse">
                            <i class="fa fa-minus"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    <table id="tbl-list" data-server="false" class="dt-table table nowrap table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
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