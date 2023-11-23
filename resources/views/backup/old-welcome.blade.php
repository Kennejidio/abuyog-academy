<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
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
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}" class="btn ms-auto d-none d-lg-block">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="btn ms-auto d-none d-lg-block">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('student.student-register') }}" class="btn  d-none d-lg-block">Register</a>
                            @endif
                        @endauth
                    @endif
                    <ul class="navbar-nav ms-auto d-lg-none">
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link btn" href="{{ url('/home') }}">Home</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link btn" href="{{ route('login') }}">Login</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link btn" href="{{ route('student.student-register') }}">Register</a>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-5">
        <h1>
            This Website is under development.
        </h1>
    </main>
    <footer class="container mt-5">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </footer>
</body>

</html>
