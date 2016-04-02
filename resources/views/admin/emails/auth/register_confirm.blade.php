@extends('admin.emails.master')

@section('mail-title', 'Confirm Registration for ' . env('APP_TITLE'))

@section('content')

    <p class="dear">Dear <strong>{!! $name !!}</strong></p>

    <p>You have been created as an admin at {{ env('APP_TITLE') }}</p>
    <p>Please click {!! link_to('/auth/register/confirm/'.$token, 'here') !!} to activate your account. </p>
@stop