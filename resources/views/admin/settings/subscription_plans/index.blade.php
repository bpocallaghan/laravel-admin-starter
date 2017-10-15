@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-table"></i></span>
                        <span>List All SubscriptionPlans</span>
                    </h3>
                </div>

                <div class="box-body">

                    @include('admin.partials.info')

                    <div class="well well-sm well-toolbar">
                        <a class="btn btn-labeled btn-primary" href="{{ Request::url().'/create' }}">
                            <span class="btn-label"><i class="fa fa-fw fa-plus"></i></span>Create {{ ucfirst($resource) }}
                        </a>

                        <a class="btn btn-labeled btn-default text-primary" href="{{ Request::url().'/features' }}">
                            <span class="btn-label"><i class="fa fa-fw fa-tags"></i></span>Create
                            Features
                        </a>
                    </div>

                    <table id="tbl-list" data-server="false" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Features</th>
                            <th>Cost</th>
                            <th>Is Featured</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>{!! $item->features_string !!}</td>
                                <td><span>$</span> {{ $item->cost }}</td>
                                <td>
                                    <span class="label label-{{ $item->is_featured ? 'success':'warning' }}">{{ $item->is_featured ? 'Yes':'No'}}</span>
                                </td>
                                <td>
                                    <div class="btn-toolbar">
                                        {!! action_row($selectedNavigation->url, $item->id, $item->title, ['show', 'edit', 'delete'], false) !!}
                                        <div class="btn-group">
                                            <a href="{{$selectedNavigation->url . '/' . $item->id . '/features/order'}}" class="btn btn-info btn-xs" data-toggle="tooltip" title="Order Features">
                                                <i class="fa fa-align-center"></i>
                                            </a>
                                        </div>
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