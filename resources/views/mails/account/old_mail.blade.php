@component('mail::message')
# Email change

We have accepted your request to change email. Click on the button below to confirm email change.

@component('mail::button', ['url' => route('account.mail.confirm.old', $token)])
Change email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
