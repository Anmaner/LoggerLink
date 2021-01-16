@extends('layouts.app')

@section('content')
<section class="account-section bottom">
    <div class="container">
        @include('layouts.partials.flash')
        <div class="account">
            @include('layouts.partials.account_sections')
            <div class="account-content">
                <div class="content-title">Account general information</div>
                <div class="auth-content__inputs">
                    <div class="auth-content__inputs-item">
                        <div class="auth-input__title">Email Address</div>
                        <input class="auth-input__input" name="email" type="email" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="auth-content__inputs-item">
                        <div class="auth-input__title">Name</div>
                        <input class="auth-input__input" name="name" type="text" value="{{ $user->name }}" readonly>
                    </div>
                </div>
                <a href="#" class="content__button auth-content__buttons-signin disable">Send</a>
            </div>
        </div>
    </div>
</section>
@endsection
