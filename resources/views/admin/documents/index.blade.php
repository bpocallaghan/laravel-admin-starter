@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-table"></i></span>
                        <span>List All Documents</span>
                    </h3>
                </div>

                <div class="box-body">

                    @include('admin.partials.info')

                    <table id="tbl-list" data-server="false" data-page-length="25" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Belongs To</th>
                            <th>Document</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->name }} {{ $item->is_cover? '(Cover)':'' }}</td>
                                <td>{{ ($item->documentable? $item->documentable->name:'-') }}</td>
                                <td>
                                    <a target="_blank" href="{{ $item->url }}">
                                        <img style="height: 50px;" src="{{ $item->url }}" title="{{ $item->name }}">
                                    </a>
                                </td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                <td>{!! action_row($selectedNavigation->url, $item->id, $item->name, ['delete']) !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection