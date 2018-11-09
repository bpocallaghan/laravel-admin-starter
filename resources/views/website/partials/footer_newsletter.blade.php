<section class="newsletter mt-3">
    <div class="card bg-light">
        <div class="card-body">
            <h3 class="text-primary"><i class="fa fa-newspaper-o"></i> Newsletter</h3>
            <p>Sign up to our newsletter to receive the latest News from
                <strong>{{ config('app.name') }}</strong>.
            </p>

            <form id="form-newsletter-subscribe" method="post" action="/api/newsletter/subscribe">
                {!! csrf_field() !!}
                <div class="row">
                    <div class="form-group col-6 col-sm-5">
                        <label class="sr-only" for="newsletter">Full Name</label>
                        <input type="text" name="fullname" class="form-control d-block" placeholder="Full Name">
                    </div>
                    <div class="form-group col-6 col-sm-5">
                        <label class="sr-only" for="newsletter">Email Address</label>
                        <input type="text" name="email" class="form-control d-block" placeholder="Email Address">
                    </div>
                    <div class="form-group col-12 col-sm-2">
                        <button type="submit" class="btn btn-primary btn-block btn-ajax-submit">Sign up
                        </button>
                    </div>
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