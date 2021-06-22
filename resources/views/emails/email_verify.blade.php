@component('mail::message')
    # Hello

    Welcome to Movieland!

    In order to verify your email, click the button below.
    @component('mail::button', ['url' => $data['url']])
        Verify
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
