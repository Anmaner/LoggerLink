@extends('layouts.auth')

@section('content')
<header class="header-auth">
    <div class="auth">
        <div class="auth-logo">
            <a href="index.html"><img src="{{ asset('storage/img/logo.png') }}" alt="" width="170px"></a>
        </div>
        <div class="auth-content">
            @include('layouts.partials.flash')
            <form action="#" method="POST">
                <div class="auth-content__title">Sign in</div>
                <div class="auth-content__inputs">
                    <div class="auth-content__inputs-item">
                        <div class="auth-input__title">Email Adress</div>
                        <input type="text" class="auth-input__input" name="email" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                    <div class="auth-content__inputs-item">
                        <div class="auth-input__title">Password</div>
                        <input type="password" class="auth-input__input" name="password" required autocomplete="current-password">
                    </div>
                </div>
                <div class="auth-content__checkbox">
                    <input class="auth-content__checkbox-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Remember me</label>
                </div>
                <div class="auth-content__buttons">
                    <div class="auth-content__buttons-inner">
                        <input type="submit" class="content__button auth-content__buttons-signin submit" value="Sign in">
                        <a href="forgot_password.html" class="auth-content__buttons-forgot">Forgot password?</a>
                    </div>
                </div>
                @csrf()
            </form>
        </div>
    </div>
</header>
@endsection
