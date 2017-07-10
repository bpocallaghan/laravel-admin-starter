@extends('layouts.admin')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">
						<span><i class="fa fa-table"></i></span>
						<span>List All Faqs</span>
					</h3>
				</div>

				<div class="box-body">

					@include('admin.partials.info')

                    @include('admin.partials.toolbar', ['order' => true])

					<table id="tbl-list" data-server="false" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Category</th>
                            <th>Totals</th>
                            <th>Updated</th>
                            <th>Action</th>
						</tr>
						</thead>
						<tbody>
						@foreach ($items as $item)
							<tr>
                                <td>{{ $item->question }}</td>
                                <td>{!! $item->answer_summary !!}</td>
                                <td>{!! $item->category->name !!}</td>
                                <td>
                                    <span title="Total Reads" data-toggle="tooltip" class="label label-info"><i class="fa fa-eye"></i> {{ $item->total_read }}</span>
                                    <span title="Helpful Yes" data-toggle="tooltip" class="label label-success"><i class="fa fa-thumbs-up"></i> {{ $item->helpful_yes }}</span>
                                    <span title="Helpful No" data-toggle="tooltip" class="label label-danger"><i class="fa fa-thumbs-up"></i> {{ $item->helpful_no }}</span>
                                </td>
                                <td>{{ format_date($item->updated_at) }}</td>
                                <td>{!! action_row($selectedNavigation->url, $item->id, $item->title, ['show', 'edit', 'delete']) !!}</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection