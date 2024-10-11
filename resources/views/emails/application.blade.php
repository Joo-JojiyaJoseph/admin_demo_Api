@component('mail::message')
# New Application

You have received a new application from **{{ $data['name'] }}**.

- **Name:** {{ $data['name'] }}
- **Email:** {{ $data['email'] }}
- **Phone:** {{ $data['phone'] }}
- **Job Post:** {{ $data['jobs'] }}

The resume is attached to this email.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
