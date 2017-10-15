@extends('layouts.website')

@section('content')
    <section class="content">
        @include('website.partials.page_header', ['column' => 12])

        <div class="row">
            <div class="body col-sm-12">
                @include('website.partials.breadcrumb')

                <div class="row">
                    <div class="col-md-12">
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
                                        @if($item->summary && strlen($item->summary) > 2)
                                            <p style="margin: 5px 0px 0px 0px;">
                                                <i>{{ $item->summary }}</i></p>
                                        @endif
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
                </div>
            </div>
        </div>
    </section>
@endsection