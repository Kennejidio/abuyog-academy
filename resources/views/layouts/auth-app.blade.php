<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    @if (Route::currentRouteName() == 'login')
    @elseif (Route::currentRouteName() == 'register')
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
                <div class="container">
                    <a class="navbar-brand d-none d-lg-block fw-bolder" href="{{ url('/') }}">ABUYOG ACADEMY
                        INCORPORATED</a>
                    <a class="navbar-brand d-lg-none fw-bolder" href="{{ url('/') }}">ABUYOG ACADEMY INC.</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <a href="{{ route('login') }}" class="btn ms-auto d-none d-lg-block">Login</a>
                        <ul class="navbar-nav ms-auto d-lg-none">
                            <li class="nav-item">
                                <a class="nav-link btn" href="{{ route('login') }}">Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    @elseif (Route::currentRouteName() == 'student.student-register')
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
                <div class="container">
                    <a class="navbar-brand d-none d-lg-block fw-bolder" href="{{ url('/') }}">ABUYOG ACADEMY
                        INCORPORATED</a>
                    <a class="navbar-brand d-lg-none fw-bolder" href="{{ url('/') }}">ABUYOG ACADEMY INC.</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <a href="{{ route('login') }}" class="btn ms-auto d-none d-lg-block">Login</a>
                        <ul class="navbar-nav ms-auto d-lg-none">
                            <li class="nav-item">
                                <a class="nav-link btn" href="{{ route('login') }}">Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    @elseif (Route::currentRouteName() == 'verification.notice')
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
                <div class="container">
                    <a class="navbar-brand d-none d-lg-block fw-bolder" href="{{ url('/') }}">ABUYOG ACADEMY
                        INCORPORATED</a>
                    <a class="navbar-brand d-lg-none fw-bolder" href="{{ url('/') }}">ABUYOG ACADEMY INC.</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <a class="btn ms-auto d-none d-lg-block" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <img src="{{ asset('svg/logout.svg') }}" alt="logo">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <ul class="navbar-nav ms-auto d-lg-none">
                            <li class="nav-item">
                                <a class="nav-link btn" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                    <img src="{{ asset('svg/logout.svg') }}" alt="logo">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    @endif

    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>
