@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-table"></i></span>
                        <span>List All Navigations</span>
                    </h3>
                </div>

                <div class="box-body">

                    @include('admin.partials.info')

                    @include('admin.partials.toolbar', ['order' => true])

                    <table id="tbl-list" data-server="false" class="dt-table table nowrap table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th class="desktop">Description</th>
                            <th>Slug</th>
                            <th>Url</th>
                            <th>Parent</th>
                            <th>Main</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>{!! $item->html_description !!}</td>
                                <td>{!! $item->slug !!}</td>
                                <td>{!! $item->url !!}</td>
                                <td>{{ ($item->parent)? $item->parent->title : '-' }}</td>
                                <td>{{ ($item->is_main == 1)? 'Yes' : '' }}</td>
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