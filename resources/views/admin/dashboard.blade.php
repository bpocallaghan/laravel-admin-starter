@extends('layouts.admin')

@section('content')

    <div class="well well-sm bg-gray-light">
        <ul>
            <li><strong>uBlock Origin</strong> browser extension block the '<strong>/api/analtyics</strong>' ajax to
                get the google analytics
            </li>
            <li>
                <a target="_blank" href="https://github.com/bpocallaghan/impersonate">Impersonation</a>.
                Go <a href="/admin/settings/admin/users">here</a> and click on the 'impersonate
                user' action
            </li>
        </ul>
    </div>

    @include('admin.partials.analytics.analytics_header')

    <div class="row">
        <div class="col-sm-12">
            @include('admin.partials.analytics.visitors_views')
        </div>
    </div>

    {{-- devices + browsers --}}
    <div class="row">
        <div class="col-md-6">
            @include('admin.partials.analytics.devices_category')
        </div>

        <div class="col-md-6">
            @include('admin.partials.analytics.browsers')
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            @include('admin.partials.analytics.devices')
        </div>
        <div class="col-sm-6">
            @include('admin.partials.analytics.visited_pages')
        </div>
    </div>
@endsection