@extends('layouts.admin')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">
						<span><i class="fa fa-table"></i></span>
						<span>List All AnnualReports</span>
					</h3>
				</div>

				<div class="box-body">

					@include('admin.partials.info')

					@include('admin.partials.toolbar')

					<table id="tbl-list" data-server="false" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
                        <tr>
                            <th>Title</th>
                            <th class="desktop">Description</th>
                            <th>Active From</th>
                            <th>Active To</th>
                            <th>Document</th>
                            <th>Downloads</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{!! $item->content !!}</td>
                                <td>{{ $item->active_from->format('d M Y') }}</td>
                                <td>{{ $item->active_to? $item->active_to->format('d M Y') : '-' }}</td>
                                <td>
                                    <a target="_blank" href="{{ $item->document_url }}">{!! $item->document->name !!}</a>
                                </td>
                                <td>{{ $item->total_downloads }}</td>
                                <td>{!! action_row($selectedNavigation->url, $item->id, $item->name, ['edit', 'delete']) !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection