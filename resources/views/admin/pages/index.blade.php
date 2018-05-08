@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-table"></i></span>
                        <span>List All Pages</span>
                    </h3>
                </div>

                <div class="box-body">

                    @include('admin.partials.info')

                    <div class="well well-sm well-toolbar">
                        <a class="btn btn-labeled btn-primary" href="{{ request()->url().'/create' }}">
                            <span class="btn-label"><i class="fa fa-fw fa-plus"></i></span>Create {{ ucfirst($resource) }}
                        </a>

                        <a class="btn btn-labeled btn-default text-black" href="{{ request()->url().'/order' }}">
                            <span class="btn-label"><i class="fa fa-fw fa-align-center"></i></span>General Order
                        </a>

                        <a class="btn btn-labeled btn-default text-black" href="{{ request()->url().'/order/header' }}">
                            <span class="btn-label"><i class="fa fa-fw fa-align-center"></i></span>{{ ucfirst($resource) }}
                            Header Order
                        </a>

                        <a class="btn btn-labeled btn-default text-black" href="{{ request()->url().'/order/footer' }}">
                            <span class="btn-label"><i class="fa fa-fw fa-align-center"></i></span>{{ ucfirst($resource) }}
                            Footer Order
                        </a>
                    </div>

                    <table id="tbl-list" data-server="false" data-page-length="25" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Page</th>
                            <th>Description</th>
                            <th>Url</th>
                            <th>Parent</th>
                            <th style="min-width: 100px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{!! $item->description !!}</td>
                                <td>{!! $item->url !!}</td>
                                <td>{{ ($item->parent)? $item->parent->title : '-' }}</td>
                                <td>
                                    <div class="btn-toolbar">
                                        <div class="btn-group">
                                            <a href="/admin/pages/{{ $item->id }}/sections" class="btn btn-info btn-xs" data-toggle="tooltip" title="Manage Page Content">
                                                <i class="fa fa-wpforms"></i>
                                            </a>
                                        </div>
                                        {!! action_row($selectedNavigation->url, $item->id, $item->name, ['edit', 'delete'], false) !!}
                                    </div>
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