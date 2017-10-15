@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-eye"></i></span>
                        <span>Subscription Plans - {{ $item->title }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    <form>
						<fieldset>
							<div class="row">
								<section class="col col-6">
									<section class="form-group">
										<label>Title</label>
										<input type="text" class="form-control" value="{{ $item->title }}" readonly>
									</section>
								</section>

								<section class="col col-6">
									<section class="form-group">
										<label>Cost</label>
										<input type="text" class="form-control" value="{{ $item->cost }}" readonly>
									</section>
								</section>
							</div>

							<section class="form-group">
								<label>Summary</label>
								<div class="well well-light well-form-description">
									{!! $item->summary !!}
								</div>
							</section>

                            <hr/>

                            <div class="col-md-4">
                                <div class="panel {{ ($item->is_featured? 'panel-primary':'panel-default') }}  text-center">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            {{ $item->title }}
                                            @if($item->is_featured)
                                                <span class="label label-success">Best Value</span>
                                            @endif
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        <span class="price">$<strong>{{ $item->cost }}</strong></span>
                                        <span class="period">per month</span>
                                    </div>
                                    <ul class="list-group">
                                        @foreach($item->features as $feature)
                                            <li class="list-group-item">{!! $feature->title !!}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
						</fieldset>

                    	@include('admin.partials.form_footer', ['submit' => false])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection