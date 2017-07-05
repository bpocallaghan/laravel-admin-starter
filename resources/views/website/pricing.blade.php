@extends('layouts.website')

@section('content')
    <div class="row">

        <div class="row">
            <div class="col-md-12 text-center">
                <i>You can manage the plans in the cms.</i>
            </div>
        </div>

        <hr/>

        @foreach($subscriptionPlans as $item)
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
                        <span class="price"><sup>$</sup>{{ $item->cost }}</span>
                        <span class="period">per month</span>
                    </div>
                    <ul class="list-group">
                        @foreach($item->features as $feature)
                            <li class="list-group-item">{!! $feature->title !!}</li>
                        @endforeach
                        <li class="list-group-item">
                            <a href="#" class="btn btn-primary">Sign Up!</a>
                        </li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
@endsection