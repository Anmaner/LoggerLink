@extends('layouts.app')

@section('content')
<section class="account-section bottom">
    <div class="container">
        @if(session('errors') || session('success') || session('error') || session('status'))
            @include('layouts.partials.flash')
        @elseif($emailChange && $emailChange->isOldRequested())
            <div class="status">
                <div class="status-bar status-success">
                    <span>Verification token is sent. Please check your current email-address.</span>
                    <a class="email-change_cancel" href="{{ route('account.mail.reset') }}">Cancel email change.</a>
                </div>
            </div>
        @elseif($emailChange && $emailChange->isOldConfirmed())
            <div class="status">
                <div class="status-bar status-success">
                    <span>Old email-address is confirmed. Now you can request email to new email-address.</span>
                    <a class="email-change_cancel" href="{{ route('account.mail.reset') }}">Cancel email change.</a>
                </div>
            </div>
        @elseif($emailChange && $emailChange->isNewRequested())
            <div class="status">
                <div class="status-bar status-success">
                    <span>Verification token is sent to your new email-address.</span>
                    <a class="email-change_cancel" href="{{ route('account.mail.reset') }}">Cancel email change.</a>
                </div>
            </div>
        @endif
            <div class="account account-mail">
                @include('layouts.partials.account_sections')
                @if(!$emailChange)
                    <div class="account-content">
                        <div class="content-title">Change email</div>
                        <form action="{{ route('account.mail.request.old') }}" method="POST">
                            <div class="auth-content__inputs">
                                <div class="auth-content__inputs-item">
                                    <div class="auth-input__title">New email Address</div>
                                    <input type="text" class="auth-input__input" name="email" required autocomplete="email">
                                </div>
                            </div>
                            @if(!$emailChange)
                                <p class="content-text">We will send a link to your old email. Then you should confirm your new email.</p>
                            @endif
                            <input type="submit" class="content__button auth-content__buttons-signin submit" value="Send">
                            @csrf()
                        </form>
                    </div>
                @endif
                @if($emailChange && $emailChange->isOldConfirmed())
                    <div class="account-content">
                        <div class="content-title">Request verification for new email.</div>
                        <form action="{{ route('account.mail.request.new') }}" method="POST">
                            <input type="submit" class="content__button auth-content__buttons-signin submit" value="Send">
                            @csrf()
                        </form>
                    </div>
                @endif
            </div>
    </div>
</section>
@endsection
