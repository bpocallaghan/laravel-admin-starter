@extends('layouts.website')

@section('content')
    <section class="content bg-default padding padding-top padding-bottom">
        @include('website.partials.page_header')

        <div class="row">
            <div class="body col-sm-7 col-lg-8">
                @include('website.partials.breadcrumb')

                <div class="row">
                    @foreach($items as $item)
                        <div class="col-sm-12">
                            <h2>{!! $item->name !!}</h2>
                            <p>
                                Start Date: {{ $item->active_from->format('d F Y') }}
                                - Closing Date: {{ $item->active_to_formatted }}
                            </p>
                            <div style="max-height: 90px; height: auto; overflow: hidden;">
                                {!! $item->content !!}
                            </div>
                            <a data-id="{{ $item->id }}" target="_blank" href="{{ $item->document_url }}" class="js-track-download">
                                Download Annual Report
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            @include('website.partials.page_side')
        </div>
    </section>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
            $('.js-track-download').on('click', function() {
                doAjax('{{ Request::url() }}/' + $(this).attr('data-id') + '/download');
            })
        })
    </script>
@endsection
