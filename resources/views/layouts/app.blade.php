<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LoggerLink</title>

    <script src="{{ mix('js/app.js', 'build') }}" defer></script>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="{{ mix('css/app.css', 'build') }}" rel="stylesheet">
</head>
<body>
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
                                <li class="dropdown-item"><a href="create_page.html">Logger create</a></li>
                                <li class="dropdown-item"><a href="create_page.html">#ye24f91Sjby7</a></li>
                                <li class="dropdown-item"><a href="create_page.html">#ye24f91Sjby7</a></li>
                            </ul>
                        </li>
                        <li class="sections-second">
                            <a class="sign_up" href="#"><i class="fa fa-caret-square-o-down fa-less" aria-hidden="true"></i> Shortener</a>
                            <ul class="dropdown">
                                <li class="dropdown-item"><a href="create_page_shortener.html">Shortener create</a></li>
                                <li class="dropdown-item"><a href="create_page_shortener.html">#ye24f91Sjby7</a></li>
                                <li class="dropdown-item"><a href="create_page_shortener.html">#ye24f91Sjby7</a></li>
                            </ul>
                        </li>
                    </ul>
                    <span class="divide">|</span>
                    <ul class="login_section">
                        <li><a class="login" href="sign_in.html"><i class="fa fa-sign-in fa-less" aria-hidden="true"></i> Login</a></li>
                        <li><a class="sign_up" href="sign_up.html"><i class="fa fa-user-plus fa-less" aria-hidden="true"></i> Sign up</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="header-line"></div>
    </header>
    @yield('content')
</body>
</html>