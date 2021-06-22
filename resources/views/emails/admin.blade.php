@component('mail::message')
# Message from {{ $full_name }}

E-mail: {{ $email }}

{{ $message }}

@endcomponent
