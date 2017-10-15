@component('mail::message')
{{-- Greeting --}}
# Dear {{ $userInvite->email }}

{{-- Intro Lines --}}
You have been invited to be an administrator at {{ config('app.name') }}<br/>
Please click <a href="{{ url('/auth/register/'.$userInvite->token) }}">here</a> to create your account.<br/><br/>

{{-- Action Button --}}
@component('mail::button', ['url' => url('/auth/register/'.$userInvite->token), 'color' => 'blue'])
Create Account
@endcomponent

Regards,<br>{{ config('app.name') }}

{{-- Subcopy --}}
@component('mail::subcopy')
If you’re having trouble clicking the "Create Account" button, copy and paste the URL below
into your web browser: [{{ url('/auth/register/'.$userInvite->token) }}]({{ url('/auth/register/'.$userInvite->token) }})
@endcomponent

@endcomponent
