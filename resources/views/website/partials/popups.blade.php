@if(isset($popup) && $popup)
    <div id="modal-popup" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">
                        <i class="{{ $popup->icon_class }}"></i> {{ $popup->title }}</h4>
                </div>
                <div class="modal-body">
                    {{ $popup->summary }}
                    <img style="width: 100%; padding: 10px 0px 15px;" src="{{ uploaded_images_url($popup->image_thumb) }}" alt="{{ $popup->title }}">
                    <a class="btn_1" href="{{ $popup->url }}">View {{ $popup->type }}</a>
                </div>
                <div class="modal-footer">
                    <small>Autoclose delay in 10 seconds.</small>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function () {
            var prevId = Cookies.get('popup-entry');
            var id = "{{$popup->id . '|' . $popup->type}}";

            // if popup entry is new or first time ever loading page
            // create a cookie that will expire in 14 days
            if (prevId != id) {
                Cookies.remove('popup-entry');
                Cookies.set('popup-entry', id, {expires: 14});

                // open model with a slight delay
                setTimeout(function () {
                    $('#modal-popup').modal('show');

                    // close in 10 sec
                    setTimeout(function () {
                        $('#modal-popup').modal('hide');
                    }, 10000);
                }, 3000);
            }
        })
    </script>
@endsection
@endif

@if(!\Auth::check())
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-login">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-login" method="POST" action="/auth/login">
                    {!! csrf_field() !!}

                    <div class="modal-header">
                        <h4 class="modal-title" data-icon="fa-sign-in">Login</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <p>To access your account you will need to Login.</p>
                        <div class="row form-group">
                            <label for="email" class="col-sm-4 control-label">Email Address:</label>
                            <div class="col-sm-8">
                                <input name="email" class="form-control" type="email" placeholder="Email Address">
                                {!! form_error_message('email', $errors) !!}
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="password" class="col-sm-4 control-label">Password:</label>
                            <div class="col-sm-8">
                                <input name="password" class="form-control" type="password" placeholder="Password">
                                {!! form_error_message('password', $errors) !!}
                                <a href="{{ route('forgot-password') }}">Forgot your Password?</a>
                            </div>
                        </div>
                        <div class="row form-group ">
                            <div class="offset-sm-4 col-sm-8">
                                <div class="checkbox">
                                    <label><input type="checkbox" name="remember" checked="checked">
                                        Keep me signed in
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-feedback">
                                    <div class="feedback-alert alert hideme">
                                        Please Complete the form
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-block">
                        <div class="row">
                            <div class="col-sm-7">New to {{ config('app.name') }}?
                                <a href="/auth/register">
                                    Register here
                                </a>
                            </div>
                            <div class="col-sm-5 text-right">
                                <button type="button" class="btn btn-grey" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info btn-ajax-submit" data-icon="fa-sign-in">
                                    Login
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function () {
            $('#form-login').submit(function () {
                return submitForm($(this));
            });

            /**
             * Helper to submit the forms via ajax
             * @param form
             * @returns {boolean}
             */
            function submitForm($form)
            {
                FORM.sendFormToServer($form, $form.serialize());
                return false;
            }
        })
    </script>
@endsection
@endif