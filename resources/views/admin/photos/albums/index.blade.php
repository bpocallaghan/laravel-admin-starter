@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-table"></i></span>
                        <span>List All Photo Albums</span>
                    </h3>
                </div>

                <div class="box-body">

                    @include('admin.partials.info')

                    @include('admin.partials.toolbar')

                    <table id="tbl-list" data-server="false" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Total Photos</th>
                            <th>Cover Photo</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->photos->count() }}</td>
                                <td>
                                    @if($item->cover_photo)
                                        <a target="_blank" href="{{ $item->cover_photo->url }}">
                                            <img style="height: 50px;" src="{{ $item->cover_photo->urlForName($item->cover_photo->thumb) }}" title="{{ $item->cover_photo->name }}">
                                        </a>
                                    @endif
                                </td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="btn-toolbar">
                                        <div class="btn-group">
                                            <a href="/admin/photos/albums/{{ $item->id }}" class="btn btn-info btn-xs" data-toggle="tooltip" title="Add Photos to {{ $item->name }}">
                                                <i class="fa fa-image"></i>
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