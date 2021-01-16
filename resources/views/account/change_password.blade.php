@extends('layouts.app')

@section('content')
<section class="account-section bottom">
    <div class="container">
        @include('layouts.partials.flash')
        <div class="account">
            @include('layouts.partials.account_sections')
            <div class="account-content">
                <div class="content-title">Change password</div>
                <form action="{{ route('account.password.change') }}" method="POST">
                    <div class="auth-content__inputs">
                            <div class="auth-content__inputs-item">
                                <div class="auth-input__title">Current password</div>
                                <input type="password" class="auth-input__input" name="password" required autocomplete="current-password">
                            </div>
                            <div class="auth-content__inputs-item">
                                <div class="auth-input__title">New password</div>
                                <input type="password" class="auth-input__input" name="password_new" required autocomplete="new-password">
                            </div>
                            <div class="auth-content__inputs-item">
                                <div class="auth-input__title">Repeat password</div>
                                <input type="password" class="auth-input__input" name="password_new_confirmation" required autocomplete="new-password">
                            </div>
                    </div>
                    <input type="submit" class="content__button auth-content__buttons-signin submit" value="Send">
                    @csrf()
                </form>
            </div>
        </div>

    </div>
</section>
@endsection
