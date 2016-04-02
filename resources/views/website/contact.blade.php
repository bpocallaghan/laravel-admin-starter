@extends('layouts.website')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div>
                    <h2>Fill the form below</h2>
                </div>

                <div class="step">
                    <form id="form-contact-us" accept-charset="UTF-8" action="{{ Request::url().'/submit' }}" method="POST">
                        {!! csrf_field() !!}

                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="firstname" placeholder="Enter Name" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="lastname" placeholder="Enter Last Name" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
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
                                    <textarea rows="5" name="content" class="form-control" placeholder="Write your message" style="height:200px;" required></textarea>
                                </div>
                            </div>
                        </div>

                        @include('website.partials.form.captcha')

                        @include('website.partials.form.feedback')

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div>
                    <h4>Address <span><i class="icon-pin pull-right"></i></span></h4>
                    <p></p>
                    <hr>
                    <ul id="contact-info">
                        <li>+264xxxxxxx</li>
                        <li><a href="#">info@xxxxxxxxxx</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    @parent
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&sensor=truep&libraries=places"></script>
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
            // feedback form
            var btn = $('#form-contact-us').find('[type="submit"]');
            btn.prop('disabled', false);
            btn.val(btn.attr('data-text'));

            $('#form-contact-us').submit(function ()
            {
                var inputs = [
                    {'name': 'firstname'},
                    {'name': 'lastname'},
                    {'name': 'email', 'email': true}
                ];

                if (validateForm($(this), inputs) === false) {
                    return false;
                }

                sendFormToServer($(this), $(this).serialize());
                return false;
            });

            var map = initGoogleMap('map-contact', -22.540180, 17.090636, 14);
            addGoogleMapsMarker(map, -22.540180, 17.090636, 'logo');
        });
    </script>
@endsection
