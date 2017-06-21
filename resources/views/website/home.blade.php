@extends('layouts.website')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Welcome to {!! config('app.name') !!}
            </h1>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><i class="fa fa-fw fa-check"></i> Laravel v5.4.27</h4>
                </div>
                <div class="panel-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio
                        corporis quae nulla aspernatur in alias at numquam rerum ea excepturi
                        expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum
                        quod?</p>
                    <a href="#" class="btn btn-default">Learn More</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><i class="fa fa-fw fa-gift"></i> Free &amp; Open Source</h4>
                </div>
                <div class="panel-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio
                        corporis quae nulla aspernatur in alias at numquam rerum ea excepturi
                        expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum
                        quod?</p>
                    <a href="#" class="btn btn-default">Learn More</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><i class="fa fa-fw fa-compass"></i> Easy to Use</h4>
                </div>
                <div class="panel-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio
                        corporis quae nulla aspernatur in alias at numquam rerum ea excepturi
                        expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum
                        quod?</p>
                    <a href="#" class="btn btn-default">Learn More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <!-- Portfolio Section -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Portfolio Heading</h2>
        </div>
        <div class="col-md-4 col-sm-6">
            <a href="#">
                <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
            </a>
        </div>
        <div class="col-md-4 col-sm-6">
            <a href="#">
                <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
            </a>
        </div>
        <div class="col-md-4 col-sm-6">
            <a href="#">
                <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
            </a>
        </div>
        <div class="col-md-4 col-sm-6">
            <a href="#">
                <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
            </a>
        </div>
        <div class="col-md-4 col-sm-6">
            <a href="#">
                <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
            </a>
        </div>
        <div class="col-md-4 col-sm-6">
            <a href="#">
                <img class="img-responsive img-portfolio img-hover" src="http://placehold.it/700x450" alt="">
            </a>
        </div>
    </div>
    <!-- /.row -->

    <!-- Features Section -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Features</h2>
        </div>
        <div class="col-md-6">
            <ul>
                <li><strong>Laravel v5.4.27</strong></li>
                <li><strong>AdminLTE v2.4.0</strong></li>
                <li><strong>Bootstrap v3.3.7</strong></li>
                <li><strong>jQuery v3.2.1</strong></li>
                <li>Auth (Login, Register, Forgot Password)</li>
                <li>Roles (Basic)</li>
                <li>Navigation (Website + Admin)</li>
                <li>Testimonials</li>
                <li>Locations</li>
                <li><strong>Actions</strong></li>
                <li><strong>Notifications</strong></li>
                <li><strong>Google Analytics Reports</strong></li>
                <li>Banners</li>
            </ul>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, omnis doloremque
                non cum id reprehenderit, quisquam totam aspernatur tempora minima unde aliquid ea.</p>
        </div>
        <div class="col-md-6">
            <img class="img-responsive" src="http://placehold.it/700x450" alt="">
        </div>
    </div>
    <!-- /.row -->

    <hr>

    <!-- Call to Action Section -->
    <div class="well">
        <div class="row">
            <div class="col-md-8">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita,
                    saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias
                    asperiores commodi.</p>
            </div>
            <div class="col-md-4">
                <a class="btn btn-lg btn-default btn-block" href="#">Call to Action</a>
            </div>
        </div>
    </div>


@endsection