@extends('layouts.website')

@section('content')
    <section class="content p-3">
        @include('website.partials.page_header')

        <div class="row">
            <div class="body col-sm-7 col-lg-8">
                @include('website.partials.breadcrumb')

                <div id="faq-box" class="row mt-3">
                    <div class="col-md-12">
                        @foreach($items as $category)
                            <h3 class="faq-category">{!! $category->name !!}</h3>
                            <div class="{{ $category->slug }}">
                                @foreach($category->faqs as $faq)

                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                <a data-toggle="collapse" data-parent=".{{ $category->slug }}" href="#faq-{{ $faq->id }}">{!! $faq->question !!}</a>
                                            </h4>
                                        </div>
                                        <div id="faq-{{ $faq->id }}" class="card-collapse collapse" data-id="{{ $faq->id }}">
                                            <div class="card-body">
                                                {!! $faq->answer !!}
                                            </div>
                                            <div id="faq-footer-{{ $faq->id }}" class="card-footer" style="border-top: 1px solid #ddd;">
                                                <div class="btn-group btn-group-sm">
                                                    <span class="btn" style="padding-left: 0px;">Was this question helpful?</span>
                                                    <a class="btn btn-success btn-helpful" href="#" data-id="{{ $faq->id }}" data-type="helpful_yes">
                                                        <i class="fa fa-thumbs-up"></i> Yes
                                                    </a>
                                                    <a class="btn btn-danger btn-helpful" href="#" data-id="{{ $faq->id }}" data-type="helpful_no">
                                                        <i class="fa fa-thumbs-down"></i> No
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            @include('website.partials.page_side')
        </div>
    </section>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function () {
            $('#faq-box')
                .on('show.bs.collapse', function (e) {
                    $.post('/faq/question/' + $(e.target).attr('data-id'));

                    $(e.target).parents('.card').addClass('card-info');
                })
                .on('hide.bs.collapse', function (e) {
                    $(e.target).parents('.card').removeClass('card-info');
                });

            $('.btn-helpful').on('click', function (e) {
                e.preventDefault();

                // show spinner
                var $footer = $('#faq-footer-' + $(this).attr('data-id'));
                $footer.html("<i class=\"fa fa-spinner fa-spin text-primary text-sm\"></i>");

                // post and show response
                $.post('/faq/question/' + $(this).attr('data-id') + '/' + $(this).attr('data-type'), function () {
                    $footer.html("<div><small><span class=\"text-muted\">Thank you for your feedback.</span></small></div>");
                });
                return false;
            });
        })
    </script>
@endsection