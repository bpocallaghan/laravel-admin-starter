@extends('layouts.website')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-8">
                <div id="js-map-contact-us" class="google_maps" style="height: 450px;">
                    &nbsp;
                </div>
            </div>

            <!-- Contact Details Column -->
            <div class="col-md-4">
                <h3>Contact Details</h3>
                <p>
                    Walvis Bay<br>Namibia<br>
                </p>
                <p><i class="fa fa-phone"></i>
                    <abbr title="Phone">P</abbr>: (+264) 81 825 4455</p>
                <p><i class="fa fa-envelope-o"></i>
                    <abbr title="Email">E</abbr>: <a href="mailto:name@example.com">name@example.com</a>
                </p>
                <p><i class="fa fa-clock-o"></i>
                    <abbr title="Hours">H</abbr>: Monday - Friday: 8:00 AM to 5:00 PM</p>
                <ul class="list-unstyled list-inline list-social-icons">
                    <li>
                        <a href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-linkedin-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-twitter-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <h3>Send us a Message</h3>

                <div class="step">
                    <form id="form-contact-us" accept-charset="UTF-8" action="{{ Request::url().'/submit' }}" method="POST">
                        {!! csrf_field() !!}

                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="firstname" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="lastname" placeholder="Enter Last Name">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter Email">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter Phone number">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea rows="5" name="content" class="form-control" placeholder="Write your message" style="height:200px;"></textarea>
                                </div>
                            </div>
                        </div>

                        @include('website.partials.form.captcha')

                        @include('website.partials.form.feedback')

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_key') }}"></script>
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
            $('#form-contact-us').submit(function ()
            {
                return submitForm($(this));
            });

            /**
             * Helper to submit the forms via ajax
             * @param form
             * @returns {boolean}
             */
            function submitForm($form)
            {
                var inputs = [];
                if (!FORM.validateForm($form, inputs)) {
                    return false;
                }

                FORM.sendFormToServer($form, $form.serialize());
                return false;
            }

            var map = initGoogleMap('js-map-contact-us', -22.9666717, 14.5019224, 14);
        });
    </script>
@endsection
