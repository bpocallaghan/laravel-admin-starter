@extends('layouts.website')

@section('content')
    <div class="panel-group" id="faq-box">

        <div id="faq-feedback" class="alert alert-info" role="alert" style="display: none;">
            Thank you for your feedback.
        </div>

        @foreach($items as $category)
            <div class="faq-category">{!! $category->name !!}</div>
            @foreach($category->faqs as $faq)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq-{{ $faq->id }}">{!! $faq->question !!}</a>
                        </h4>
                    </div>
                    <div id="faq-{{ $faq->id }}" class="panel-collapse collapse" data-id="{{ $faq->id }}">
                        <div class="panel-body">
                            {!! $faq->answer !!}
                        </div>

                        <div class="panel-footer">
                            <div class="btn-group btn-group-xs">
                                <span class="btn">Was this question helpful?</span>
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
        @endforeach
    </div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
            $('#faq-box')
                .on('show.bs.collapse', function (e)
                {
                    $.ajax({
                        type: "POST",
                        url: '/faq/question/' + $(e.target).attr('data-id')
                    });

                    $(e.target).parents('.panel').addClass('panel-info');
                })
                .on('hide.bs.collapse', function (e)
                {
                    $(e.target).parents('.panel').removeClass('panel-info');
                });

            $('.btn-helpful').on('click', function (e)
            {
                $.ajax({
                    type: "POST",
                    url: '/faq/question/' + $(this).attr('data-id') + '/' + $(this).attr('data-type')
                });

                showHideAlert();
            });

            var faqFeedbackTimer = null;

            function showHideAlert()
            {
                if (faqFeedbackTimer) {
                    clearTimeout(faqFeedbackTimer);
                }
                $('#faq-feedback').slideDown();

                faqFeedbackTimer = setTimeout(function ()
                {
                    $('#faq-feedback').slideUp();
                }, 3000);
            }
        })
    </script>
@endsection