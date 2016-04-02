@extends('layouts.email')

@section('content')
    <p class="dear">Hey, <strong>{!! env('MAIL_ADMIN') !!}</strong></p>

    <p>&nbsp;</p>
    <p>The following information was submitted on the <strong>{{ $obj->type }}</strong> form.</p>

    <p>&nbsp;</p>
    <p>Fullname: {!! $obj->firstname . ' ' . $obj->lastname  !!}</p>
    <p>Email: {!! $obj->email !!}</p>
    <p>Phone: {!! $obj->phone !!}</p>
    <p>Message: {!! $obj->content !!}</p>
@stop