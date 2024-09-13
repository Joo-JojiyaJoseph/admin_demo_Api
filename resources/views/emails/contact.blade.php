@component('mail::message')
# New Contact

{!! $message !!}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
