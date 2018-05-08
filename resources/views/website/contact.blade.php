@extends('layouts.website')

@section('content')
    <section class="content bg-default padding padding-top padding-bottom">

        @include('website.partials.page_header')

        <div class="row">
            <div class="body col-sm-7 col-lg-8">

                @include('website.partials.breadcrumb')

                <h2>Send us a Message</h2>
                <form id="form-contact-us" accept-charset="UTF-8" action="{{ request()->url().'/submit' }}" method="POST">
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
                                <input type="text" name="email" class="form-control" placeholder="Enter Email">
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
                        <div class="col-md-12 mb-5">
                            <button type="submit" class="btn btn-primary btn-submit">Send
                                Message
                            </button>
                        </div>
                    </div>
                </form>

                <h2>Find Us</h2>
                <div id="js-map-contact-us" class="google_maps" style="height: 450px;"></div>
            </div>

            <div class="side hidden-xs col-sm-5 col-lg-4">
                <div class="well">
                    <div class="side-heading">Contact Details</div>
                    <p>Walvis Bay, Namibia.</p>
                    <p>Tel: (+264) xxxx</p>
                    <p><a href="#">info@example.com</a></p>
                    <p class="social">
                        <a href="#" data-icon="fa-facebook"></a>
                        <a href="#" data-icon="fa-twitter"></a>
                        <a href="#" data-icon="fa-linkedin"></a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_key') }}"></script>
    <script type="text/javascript" charset="utf-8">
        $(function () {
            $('#form-contact-us').submit(function () {
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
//            addGoogleMapsMarker(map, -22.6228835, 17.0939617, false);
        });
    </script>
@endsection
