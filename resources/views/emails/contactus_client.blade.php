@component('mail::message')
# Dear {!! $contactUs->fullname !!}
<br/>
Thank you for getting in touch!<br/>

We appreciate you contacting us. We have received your message and will respond as soon as possible.<br/>

Regards,<br>{{ config('app.name') }}
@endcomponent
