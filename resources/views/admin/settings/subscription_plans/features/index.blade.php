@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-table"></i></span>
                        <span>List All Subscription Plan Features</span>
                    </h3>
                </div>

                <div class="box-body">

                    @include('admin.partials.info')

                    <div class="well well-sm well-toolbar">
                        <a class="btn btn-labeled btn-primary" href="{{ Request::url().'/create' }}">
                            <span class="btn-label"><i class="fa fa-fw fa-plus"></i></span>Create {{ ucfirst($resource) }}
                        </a>

                        <a href="/admin/settings/subscription-plans" class="btn btn-labeled btn-default">
                            <span class="btn-label"><i class="fa fa-fw fa-chevron-left"></i></span>Subscription Plans
                        </a>
                    </div>

                    <table id="tbl-list" data-server="false" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{!! $item->title !!}</td>
                                <td>
                                    {!! action_row($selectedNavigation->url, $item->id, $item->title, ['edit', 'delete']) !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection