@extends('admin.emails.master')

@section('title', 'Password Reset for ' . env('APP_TITLE'))

@section('content')
	<p class="dear">Dear <strong>{{ $user->fullname }}</strong></p>

    <p>To reset your password, please click <a href="{{ $link = url('auth/password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">here</a>.

	<p>This link will expire in {{ config('auth.password.expire', 60) }} minutes.</p>
@stop
