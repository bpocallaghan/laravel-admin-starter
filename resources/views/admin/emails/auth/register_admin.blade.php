@extends('admin.emails.master')

@section('mail-title', 'Confirm Registration for ' . env('APP_TITLE'))

@section('content')

    <p class="dear">Dear <strong>{!! $name !!}</strong></p>

    <p>{!! $registeredUserName !!} has just registered as an admin at {{ env('APP_TITLE') }} with {{ $registeredUserEmail }} as his email</p>
@stop