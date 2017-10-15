@extends('layouts.website')

@section('content')
    <section class="content">
        @include('website.partials.page_header')

        <div class="row">
            <div class="body col-sm-7 col-lg-8">
                @include('website.partials.breadcrumb')

                @foreach($activePage->components as $content)
                    @include('website.pages.page_heading')

                    @if($content->type == 'content')
                        @include('website.pages.page_content')
                    @elseif($content->type == 'media')
                        @include('website.pages.page_media')
                    @elseif($content->type == 'gallery')
                        @include('website.pages.page_gallery')
                    @endif
                @endforeach
            </div>

            @include('website.partials.page_side')
        </div>
    </section>
@endsection