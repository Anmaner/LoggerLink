@component('mail::message')
# Email change

Click on the button below to confirm email change.

@component('mail::button', ['url' => route('account.mail.confirm.new', $token)])
    Change email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
