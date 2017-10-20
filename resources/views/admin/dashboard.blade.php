@extends('layouts.admin')

@section('content')
    <div class="well well-sm bg-gray-light">
        <div class="row">
            <div class="col-md-6">
                <ul>
                    <li>
                        <a href="/changelog" target="_blank"><strong>CHANGELOG</strong></a> &bullet;
                        <a href="/" target="_blank"><strong>WEBSITE HOME</strong></a>
                    </li>
                    <li><strong>uBlock Origin</strong> browser extension block the '<strong>/api/analtyics</strong>'
                        ajax to
                        get the google analytics
                    </li>

                    <p style="margin-top: 10px; margin-bottom: 0;">
                        <strong>Personal Packages Included</strong>
                    </p>
                    <li>
                        <a target="_blank" href="https://github.com/bpocallaghan/generators">File
                            Generators</a>.
                        Laravel 5 File Generators with config and publishable stubs
                    </li>
                    <li>
                        <a target="_blank" href="https://github.com/bpocallaghan/notify">Notify</a>.
                        Laravel 5 Flash Notifications with icons and animations and with a timeout
                    </li>
                    <li>
                        <a target="_blank" href="https://github.com/bpocallaghan/alert">Alert</a>.
                        A helper package to flash a bootstrap alert to the browser via a Facade or a
                        helper function.
                    </li>
                    <li>
                        <a target="_blank" href="https://github.com/bpocallaghan/impersonate">Impersonate
                            User</a>.
                        This allows you to authenticate as any of your customers.
                    </li>
                    <li>
                        <a target="_blank" href="https://github.com/bpocallaghan/sluggable">Sluggable</a>.
                        Provides a HasSlug trait that will generate a unique slug when saving your
                        Laravel Eloquent model.
                    </li>
                </ul>
            </div>

            <div class="col-md-6">
                <ul>
                    <p style="margin-top: 5px; margin-bottom: 0;">
                        <strong>Highlited Features</strong>
                    </p>
                    <li>
                        <a target="_blank" href="https://github.com/bpocallaghan/impersonate">Impersonation</a>.
                        Go <a href="/admin/settings/admin/users">here</a> and click on the
                        'impersonate
                        user' action
                    </li>
                    <li>
                        <a target="_blank" href="/admin/latest-activity/website">Latest Activity
                            Notification</a>.
                        Get notified when activity is happening, also in header icons above.
                    </li>
                    <li>
                        <a target="_blank" href="/admin/settings/roles">Roles</a>.
                        Roles are linked to users and navigation, can only see selected navigation
                        for role.
                    </li>
                    <li>
                        <a href="/admin/general/tags">Basic CRUD</a>.
                        Banners, Tags, Testimonials, Changelog, Subscription Plan, Locations
                    </li>
                    <li>
                        <a href="/admin/pages">Page Builder</a>.
                        Mange the website's pages and their content.
                    </li>
                    <li>
                        <a href="/admin/analytics">Google Analytics</a>.
                        Many Google Analytics Reports
                    </li>
                    <li>
                        <a href="/admin/faqs">FAQ</a>.
                        Manage FAQ and display on website
                    </li>
                    <li>
                        <a href="/admin/blog">Blog</a>.
                        Categories and Articles
                    </li>
                </ul>
            </div>
        </div>
    </div>

    @include('admin.analytics.partials.analytics_header')

    <div class="row">
        <div class="col-sm-12">
            @include('admin.analytics.partials.visitors_views')
        </div>
    </div>

    {{-- locations + most visited pages --}}
    <div class="row">
        <div class="col-md-5">
            @include('admin.analytics.partials.visited_pages')
        </div>

        <div class="col-md-7">
            @include('admin.analytics.partials.locations')
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            @include('admin.analytics.partials.devices')
        </div>
        <div class="col-sm-6">
            @include('admin.analytics.partials.browsers')
        </div>
    </div>
@endsection