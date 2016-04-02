@extends('layouts.email')

@section('content')
    <p class="dear">Hey, <strong>{!! $obj->firstname . ' ' . $obj->lastname  !!}</strong></p>

    <p>&nbsp;</p>
    <p>Thank you for getting in touch!</p>

    <p>We appreciate you contacting us from the <strong>{{ $obj->type }}</strong> form. We have received your message and will respond as soon as possible.</p>
    <p>Talk soon.</p>
@stop