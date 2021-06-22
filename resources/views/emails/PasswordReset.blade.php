@component('mail::message')
# You have requested a password reset

Your new password is below.

@component('mail::panel')
    {{$data['new_password']}}
@endcomponent

You can change it in settings later.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
