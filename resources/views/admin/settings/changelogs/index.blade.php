@extends('layouts.admin')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">
						<span><i class="fa fa-table"></i></span>
						<span>List All Changelogs</span>
					</h3>
				</div>

				<div class="box-body">

					@include('admin.partials.info')

					@include('admin.partials.toolbar')

					<table id="tbl-list" data-order-by="0|desc" data-server="false" class="dt-table table nowrap table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Version</th>
                            <th>Date At</th>
                            <th class="desktop">Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>v{{ ($item->version) }}</td>
                                <td>{{ format_date($item->date_at) }}</td>
                                <td>{!! $item->content !!}</td>
                                <td>{!! action_row($selectedNavigation->url, $item->id, $item->title, ['edit', 'delete']) !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection