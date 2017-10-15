@extends('layouts.website')

@section('content')
    <section class="content">
        @include('website.partials.page_header')

        <div class="row">
            <div class="body col-sm-7 col-lg-8">
                @include('website.partials.breadcrumb')

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2>{!! user()->fullname !!}</h2>

                                <div class="col-sm-6">
                                    <div class="well">
                                        <p class="strong">
                                            <a href="/account/profile">
                                                <i class="fa fa-fw fa-id-card-o"></i>
                                                My Profile
                                            </a>
                                        </p>
                                        <p>Update my personal information</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('website.partials.page_side')
        </div>
    </section>
@endsection
