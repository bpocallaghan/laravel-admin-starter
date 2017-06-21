@extends('layouts.email')

@section('content')
	<p class="dear">Hi <strong>{{ $userInvite->email }}</strong></p>

	<p>You have been invited to be an administrator at {{ config('app.name') }}</p>
	<p>
        Please click
        <a href="{{ url('/auth/register/'.$userInvite->token) }}">here</a>
        to create your account.
    </p>
@stop