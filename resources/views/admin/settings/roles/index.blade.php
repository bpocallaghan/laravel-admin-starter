@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-table"></i></span>
                        <span>List All Roles</span>
                    </h3>
                </div>

                <div class="box-body">

                    @include('admin.partials.info')

                    @include('admin.partials.toolbar')

                    <table id="tbl-list" data-server="false" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Keyword</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td><i class="fa fa-{{ $item->icon }}"></i> {{ $item->name }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>{{ $item->keyword }}</td>
                                <td>
                                    @if($item->id > 5)
                                        {!! action_row($selectedNavigation->url, $item->id, $item->name, ['edit', 'delete']) !!}
                                    @else
                                        <span class="label label-warning">{{ $item->name }} Role is needed</span>
                                    @endif
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