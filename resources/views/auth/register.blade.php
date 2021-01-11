@extends('layouts.auth')

@section('content')
<header class="header-auth">
    <div class="auth auth-signup">
        <div class="auth-logo">
            <a href="index.html"><img src="{{ asset('storage/img/logo.png') }}" alt="" width="170px"></a>
        </div>
        <div class="auth-content">
            @include('layouts.partials.flash')
            <form action="{{ route('register') }}" method="POST">
                <div class="auth-content__title">Sign up</div>
                <div class="auth-content__inputs">
                    <div class="auth-content__inputs-item">
                        <div class="auth-input__title">Name</div>
                        <input type="text" class="auth-input__input" name="name" value="{{ old('name') }}" required autocomplete="name">
                    </div>
                    <div class="auth-content__inputs-item">
                        <div class="auth-input__title">Email Adress</div>
                        <input type="email" class="auth-input__input" name="email" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                    <div class="auth-content__inputs-item">
                        <div class="auth-input__title">Password</div>
                        <input type="password" class="auth-input__input" name="password" required autocomplete="new-password">
                    </div>
                    <div class="auth-content__inputs-item">
                        <div class="auth-input__title">Repeat password</div>
                        <input type="password" class="auth-input__input" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                <div class="auth-content__buttons">
                    <div class="auth-content__buttons-inner">
                        <input type="submit" class="content__button auth-content__buttons-signin submit" value="Sign up">
                        <a href="register.blade.php" class="auth-content__buttons-forgot">Already have account?</a>
                    </div>
                </div>
                @csrf
            </form>
        </div>
    </div>
</header>
@endsection
