@extends('layouts.website')

@section('content')
    <div class="row mt-5">
        <div class="col-lg-12">
            <h1 class="page-header">
                Welcome to {!! config('app.name') !!}
            </h1>
        </div>
    </div>

    <div class="row mt-2 mb-5">
        <div class="col-sm-3">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title"><i class="fa fa-fw fa-check"></i> Laravel v5.6.7</h4>
                </div>
                <div class="card-body">
                    <ul>
                        <li><strong>Laravel v5.6.7+</strong></li>
                        <li><strong>AdminLTE v2.4.2</strong></li>
                        <li><strong>Bootstrap v4.0.0</strong></li>
                        <li><strong>jQuery v3.2.1</strong></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title"><i class="fa fa-fw fa-gift"></i> Free &amp; Open Source & Many Features</h4>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-8">
                            <ul>
                                <li>Auth (Login, Register, Forgot Password)</li>
                                <li>Roles</li>
                                <li>Log Activity (website and admin)</li>
                                <li>Notifications</li>
                                <li>Google Analytics Reports</li>
                                <li>Website Page Builder (4 components)</li>
                            </ul>
                        </div>

                        <div class="col-md-4">
                            <ul>
                                <li>Banners</li>
                                <li>Page Builder</li>
                                <li>Photos</li>
                                <li>Documents</li>
                                <li>Blog</li>
                                <li>News and Events</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title"><i class="fa fa-fw fa-cubes"></i> Add On Packages</h4>
                </div>
                <div class="card-body">
                    <ul>
                        <li>
                            <a href="https://github.com/bpocallaghan/changelogs" target="_blank">Changelogs</a>
                        </li>
                        <li>
                            <a href="https://github.com/bpocallaghan/corporate" target="_blank">Corporate</a>
                        </li>
                        <li>
                            <a href="https://github.com/bpocallaghan/faq" target="_blank">Frequently Asked Questions</a>
                        </li>
                        <li>
                            <a href="https://github.com/bpocallaghan/testimonials" target="_blank">Testimonials</a>
                        </li>
                        <li>
                            <a href="https://github.com/bpocallaghan/locations" target="_blank">Locations</a>
                        </li>
                        <li>
                            <a href="https://github.com/bpocallaghan/subscriptions" target="_blank">Subscription Plans</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-12">
            <h2 class="page-header">Core Packages Included</h2>
        </div>
    </div>
    <div class="row card-columns mt-2 packages">
        <div class="col-md-4 col-sm-6">
            <a target="_blank" href="https://github.com/bpocallaghan/generators">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="card-title text-primary">File Generators</h3>
                        <div class="description">
                            Laravel 5 File Generators with config and publishable stubs
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-sm-6">
            <a target="_blank" href="https://github.com/bpocallaghan/impersonate">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="card-title text-primary">Impersonate User</h3>
                        <div class="description">
                            This allows you to authenticate as any of your customers.
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-sm-6">
            <a target="_blank" href="https://github.com/bpocallaghan/sluggable">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="card-title text-primary">Sluggable</h3>
                        <div class="description">
                            Provides a HasSlug trait that will generate a unique slug when saving
                            your Laravel Eloquent model.
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-sm-6">
            <a target="_blank" href="https://github.com/bpocallaghan/notify">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="card-title text-primary">Notification</h3>
                        <div class="description">
                            Laravel 5 Flash Notifications with icons and animations and with a
                            timeout
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-sm-6">
            <a target="_blank" href="https://github.com/bpocallaghan/alert">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="card-title text-primary">Alert</h3>
                        <div class="description">
                            A helper package to flash a bootstrap alert to the browser via a Facade
                            or a helper function.
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-sm-6">
            <a target="_blank" href="https://github.com/bpocallaghan/titan">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="card-title text-primary">Titan</h3>
                        <div class="description">
                            Projects Core Useful classes you can use for every Laravel project
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    @include('website.partials.footer_newsletter')

    <!-- Call to Action Section -->
    <div class="card bg-light mt-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <p>A Laravel CMS Starter project with AdminLTE, Roles, Impersonations, Analytics,
                        Activity, Notifications and more.</p>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-lg btn-default btn-block" href="https://github.com/bpocallaghan/laravel-admin-starter">
                        <i class="fa fa-github"></i>
                        Read More on GitHub
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection