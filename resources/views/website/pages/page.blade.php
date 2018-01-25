@extends('layouts.website')

@section('content')
    <section class="content bg-default padding padding-top padding-bottom">
        @include('website.partials.page_header')

        <div class="row">
            <div class="body col-sm-7 col-lg-8">
                @include('website.partials.breadcrumb')

                @foreach($activePage->components as $content)
                    @include('website.pages.page_heading')
                    @include('website.pages.page_content')

                    @include('website.pages.page_gallery')
                    @include('website.pages.page_documents')
                @endforeach

                @if($childrenPages && $childrenPages->count() > 0)
                    <div class="row style3 padding-bottom">
                        @foreach($childrenPages as $item)
                            <div class="col-sm-6 col-md-4">
                                <div class="box">
                                    <h3>{{ $item->name }}</h3>
                                    <div class="limit">
                                        <p>{{ $item->description }}</p>
                                    </div>
                                    <a href="{{ $item->url }}">read more
                                        <i data-icon="fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            @include('website.partials.page_side')
        </div>
    </section>
@endsection