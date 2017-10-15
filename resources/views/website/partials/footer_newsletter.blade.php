<section class="newsletter">
    <div class="well">
        <h3 class="text-primary"><i class="fa fa-newspaper-o"></i> Newsletter</h3>
        <p>Sign up to our newsletter to receive the latest News from
            <strong>{{ config('app.name') }}</strong>.
        </p>

        <form id="form-newsletter-subscribe" class="form-horizontal" method="post" action="/api/newsletter/subscribe">
            {!! csrf_field() !!}

            <div class="col-xs-6 col-sm-5">
                <label class="sr-only" for="newsletter">Full Name</label>
                <input type="text" name="fullname" class="form-control" placeholder="Full Name">
            </div>
            <div class="col-xs-6 col-sm-5">
                <label class="sr-only" for="newsletter">Email Address</label>
                <input type="text" name="email" class="form-control" placeholder="Email Address">
            </div>
            <div class="col-xs-12 col-sm-2">
                <button type="submit" class="btn btn-primary btn-block btn-ajax-submit">Sign up
                </button>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="feedback-alert alert hidden" style="margin-top: 10px;">Please
                        Complete the form
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function () {
            $('#form-newsletter-subscribe').submit(function () {
                FORM.sendFormToServer($(this), $(this).serialize());
                return false;
            });
        })
    </script>
@endsection