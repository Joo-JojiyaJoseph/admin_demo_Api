@component('mail::message')
# New Application

You have received a new application from **{{ $data['name'] }}**.

- **Name:** {{ $data['name'] }}
- **Email:** {{ $data['email'] }}
- **Phone:** {{ $data['phone'] }}

@endcomponent
