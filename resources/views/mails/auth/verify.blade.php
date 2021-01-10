@component('mail::message')
# Email verification

Thanks for registering for an account. To verify your email address, please click the link below.

@component('mail::button', ['url' => route('verify', $user->verify_token)])
Verify Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
