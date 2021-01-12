@extends('layouts.auth')

@section('content')
<header class="header-auth">
    <div class="auth auth-forgot">
        <div class="auth-logo">
            <a href="index.html"><img src="{{ asset('storage/img/logo.png') }}" alt="" width="170px"></a>
        </div>
        <div class="auth-content">
            @include('layouts.partials.flash')
            <form action="{{ route('password.update') }}" method="POST">
                <div class="auth-content__title">Reset Password</div>

                <div class="auth-content__inputs">
                    <div class="auth-content__inputs-item">
                        <div class="auth-input__title">Email Adress</div>
                        <input class="auth-input__input" type="email" name="email" value="{{ $email ?? old('email') }}"
                            required autocomplete="email">
                    </div>
                    <div class="auth-content__inputs-item">
                        <div class="auth-input__title">Password</div>
                        <input class="auth-input__input" type="password" name="password" required autocomplete="new-password">
                    </div>
                    <div class="auth-content__inputs-item">
                        <div class="auth-input__title">Comfirm password</div>
                        <input class="auth-input__input" type="password" name="password_confirmation" required
                            autocomplete="new-password">
                    </div>
                </div>

                <input type="hidden" name="token" value="{{ $token }}">

                @csrf()

                <div class="auth-content__buttons">
                    <div class="auth-content__buttons-inner">
                        <input type="submit" class="content__button auth-content__buttons-signin submit" value="Change password">
                    </div>
                </div>
            </form>
        </div>
    </div>
</header>
@endsection
