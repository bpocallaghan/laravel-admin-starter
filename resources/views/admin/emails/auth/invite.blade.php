@extends('admin.emails.master')

@section('title', 'Invite to ' . env('APP_TITLE'))

@section('content')
	<p class="dear">Dear <strong>{{ $userInvite->email }}</strong></p>

	<p>You have been invited to be an administrator at {{ env('APP_TITLE') }}</p>
	<p>Please click {!! link_to('/auth/register/'.$userInvite->token, 'here') !!} to create your account. </p>
@stop