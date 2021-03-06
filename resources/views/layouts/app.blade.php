@extends('layouts._main')

@section('body')
<header class="header">
    <div class="container">
        <div class="header-top">
            <div class="logo">
                <a href="/"><img src="{{ asset('storage/img/logo.png') }}" alt="" width="170px"></a>
            </div>
            <div class="sections">
                <ul class="tool_section">
                    <li class="sections-first">
                        <a class="login" href="#"><i class="fa fa-caret-square-o-down fa-less" aria-hidden="true"></i> Logger</a>
                        <ul class="dropdown">
                            <li class="dropdown-item"><a href="{{ route('logger.generate') }}">Logger create</a></li>
                            @foreach($loggers as $logger)
                                @if($logger->type === $logger::TYPE_LOGGER)
                                    <li class="dropdown-item">
                                        <a href="{{ route('logger.information', $logger->token) }}">#{{ $logger->token }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    <li class="sections-second">
                        <a class="sign_up" href="#"><i class="fa fa-caret-square-o-down fa-less" aria-hidden="true"></i> Shortener</a>
                        <ul class="dropdown">
                            <li class="dropdown-item"><a href="{{ route('shortener.generate') }}">Shortener create</a></li>
                            @foreach($loggers as $logger)
                                @if($logger->type === $logger::TYPE_SHORTENER)
                                    <li class="dropdown-item">
                                        <a href="{{ route('shortener.information', $logger->token) }}">#{{ $logger->token }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <span class="divide">|</span>
                <ul class="login_section">
                    @guest
                        <li class="login_section-login">
                            <a href="{{ route('login') }}"><i class="fa fa-sign-in fa-less" aria-hidden="true"></i> Login</a>
                        </li>
                        <li class="login_section-sign_up">
                            <a href="{{ route('register') }}"><i class="fa fa-user-plus fa-less" aria-hidden="true"></i> Sign up</a>
                        </li>
                    @elseauth
                        <li class="login_section-account">
                            <a href="{{ route('account.index') }}"><i class="fa fa-user fa-less" aria-hidden="true"></i> Account</a>
                        </li>
                        <form action="{{ route('logout') }}" class="form-logout" method="POST">
                            <i class="fa fa-sign-out fa-less" aria-hidden="true"></i>
                            <input type="submit" value=" Logout" class="login_section-logout">
                            @csrf()
                        </form>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
    <div class="header-line"></div>
</header>
@yield('content')
@endsection
