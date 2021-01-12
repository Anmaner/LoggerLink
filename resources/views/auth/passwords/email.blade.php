@extends('layouts.auth')

@section('content')
<header class="header-auth">
    <div class="auth auth-forgot">
        <div class="auth-logo">
            <a href="index.html"><img src="{{ asset('storage/img/logo.png') }}" alt="" width="170px"></a>
        </div>
        <div class="auth-content">
            @include('layouts.partials.flash')
            <form method="POST" action="{{ route('password.email') }}">
                <div class="auth-content__title">Reset Password</div>
                <div class="auth-content__inputs">
                    <div class="auth-content__inputs-item">
                        <div class="auth-input__title">Email Adress</div>
                        <input class="auth-input__input" type="email" name="email" value="{{ old('email') }}"
                            required autocomplete="email">
                    </div>
                </div>
                <div class="auth-content__buttons">
                    <div class="auth-content__buttons-inner">
                        <input type="submit" class="content__button auth-content__buttons-signin submit" value="Send reset password link">
                    </div>
                </div>
                @csrf()
            </form>
        </div>
    </div>
</header>
@endsection
