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
    <link rel="stylesheet" href="{{ asset('css/sidebar-sticky.css') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <!-- Header and navbar starts here -->
    <nav
        class="navbar navbar-expand-lg navbar-dark @hasanyrole('Admin') bg-danger @else @hasanyrole('Student') bg-primary @endhasanyrole @endhasanyrole sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
            <p class="navbar-brand d-none d-lg-block"> _ </p>
            @hasanyrole('Admin')
                <a class="navbar-brand d-none d-lg-block" href="#">Admin</a>
            @else
                @hasanyrole('Student')
                    <a class="navbar-brand d-none d-lg-block" href="#">Student</a>
                @endhasanyrole
            @endhasanyrole
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span><img src="{{ asset('svg/burger-menu-2-white.svg') }}" alt="logo"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto d-none d-lg-block">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('svg/burger-menu-2-white.svg') }}" alt="logo">
                        </a>
                        @hasanyrole('Admin')
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <img src="{{ asset('svg/setting.svg') }}" alt="logo">
                                        Settings
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
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
                        @else
                            @hasanyrole('Student')
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('students.settings') }}">
                                            <img src="{{ asset('svg/setting.svg') }}" alt="logo">
                                            Settings
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
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
                            @endhasanyrole
                        @endhasanyrole
                    </li>
                </ul>
                <ul class="navbar-nav d-lg-none text-center">
                    @hasanyrole('Admin')
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">
                                <img src="{{ asset('svg/setting-white.svg') }}" alt="logo">
                                Settings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                                <img src="{{ asset('svg/logout-white.svg') }}" alt="logo">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @else
                        @hasanyrole('Student')
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('students.settings') }}">
                                    <img src="{{ asset('svg/setting-white.svg') }}" alt="logo">
                                    Settings
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                                    <img src="{{ asset('svg/logout-white.svg') }}" alt="logo">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endhasanyrole
                    @endhasanyrole
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header and Navbar ends here -->


    <div class="container-fluid">
        <div class="row">
            <!-- Responsive Sidebar starts here -->
            <nav class="col-lg-2 bg-dark d-none d-lg-block">
                <div class="sidebar-sticky">
                    <ol class="nav flex-column">
                        @hasanyrole('Admin')
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard', Auth::user()) }}" class="btn btn-dark">
                                    <img src="{{ asset('svg/dashboard.svg') }}" alt="logo">
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <div class="btn btn-dark" data-bs-toggle="collapse" data-bs-target="#users">
                                    <img src="{{ asset('svg/user.svg') }}" alt="logo">
                                    Manage User
                                </div>
                                <ol id="users" class="collapse">
                                    <li><a class="btn btn-dark text-start" href="{{ route('users.index') }}">Manage
                                            Users</a></li>
                                    <li><a class="btn btn-dark" href="{{ route('roles.index') }}">Roles</a></li>
                                </ol>
                            </li>
                            <li class="nav-item">
                                <div class="btn btn-dark" data-bs-toggle="collapse" data-bs-target="#students">
                                    <img src="{{ asset('svg/student.svg') }}" alt="logo">
                                    Manage Students
                                </div>
                                <ol id="students" class="collapse">
                                    <li><a class="btn btn-dark" href="{{ route('student-admit.index') }}">Admit
                                            Students</a></li>
                                    <li><a class="btn btn-dark" href="{{ route('student-list.index') }}">Student List</a>
                                    </li>
                                    <li><a class="btn btn-dark" href="{{ route('enrollments.index') }}">Enroll
                                            Students</a></li>
                                    <li><a class="btn btn-dark" href="{{ route('student-requirements.index') }}">Student
                                            Credentials</a></li>
                                </ol>
                            </li>
                            <li class="nav-item">
                                <div class="btn btn-dark" data-bs-toggle="collapse" data-bs-target="#info">
                                    <img src="{{ asset('svg/form.svg') }}" alt="logo">
                                    Information
                                </div>
                                <ol id="info" class="collapse">
                                    <li><a class="btn btn-dark" href="{{ route('schoolyear.index') }}">Year</a></li>
                                    <li><a class="btn btn-dark" href="{{ route('grade-level.index') }}">Grade Levels</a>
                                    </li>
                                    <li><a class="btn btn-dark" href="{{ route('sections.index') }}">Sections</a></li>
                                    <li><a class="btn btn-dark" href="{{ route('requirements.index') }}">Requirements</a>
                                    </li>
                                </ol>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('billings.index') }}" class="btn btn-dark">
                                    <img src="{{ asset('svg/billing.svg') }}" alt="logo">
                                    Manage Bills
                                </a>
                            </li>
                        @else
                            @hasanyrole('Student')
                                <li class="nav-item">
                                    <a href="{{ route('students.dashboard', Auth::user()) }}" class="btn btn-dark">
                                        <img src="{{ asset('svg/dashboard.svg') }}" alt="logo">
                                        Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('students.form', ['id' => Auth::user()->id]) }}" class="btn btn-dark">
                                        <img src="{{ asset('svg/enrollment-form.svg') }}" alt="logo">
                                        Enrollment Form
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('students.credentials') }}" class="btn btn-dark">
                                        <img src="{{ asset('svg/certificate.svg') }}" alt="logo">
                                        Credentials
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('students.bills') }}" class="btn btn-dark">
                                        <img src="{{ asset('svg/billing.svg') }}" alt="logo">
                                        Bills
                                    </a>
                                </li>
                            @endhasanyrole
                        @endhasanyrole
                    </ol>
                </div>
                <div style="height: 26rem"></div>
            </nav>

            <!-- Responsive Sidebar ends here -->

            <main class="col-lg-10 col-12 pt-3 px-4">
                <!-- Toggable Responsive Side Menu Starts Here  -->
                <button class="btn btn-dark d-block d-lg-none" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                    <img src="{{ asset('svg/burger-menu-white.svg') }}" alt="logo">
                </button>
                <div class="offcanvas offcanvas-start bg-dark" data-bs-scroll="true" tabindex="-1"
                    id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title text-white" id="offcanvasWithBothOptionsLabel">Menu</h5>
                        <button type="button" class="btn btn-dark" data-bs-dismiss="offcanvas" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="offcanvas-body">
                        <ol class="nav flex-column">
                            @hasanyrole('Admin')
                                <li class="nav-item">
                                    <a href="{{ route('admin.dashboard', Auth::user()) }}" class="btn btn-dark">
                                        <img src="{{ asset('svg/dashboard.svg') }}" alt="logo">
                                        Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <div class="btn btn-dark" data-bs-toggle="collapse" data-bs-target="#users">
                                        <img src="{{ asset('svg/user.svg') }}" alt="logo">
                                        Manage User
                                    </div>
                                    <ol id="users" class="collapse">
                                        <li><a class="btn btn-dark text-start" href="{{ route('users.index') }}">Manage
                                                Users</a></li>
                                        <li><a class="btn btn-dark" href="{{ route('roles.index') }}">Roles</a></li>
                                    </ol>
                                </li>
                                <li class="nav-item">
                                    <div class="btn btn-dark" data-bs-toggle="collapse" data-bs-target="#students">
                                        <img src="{{ asset('svg/student.svg') }}" alt="logo">
                                        Manage Students
                                    </div>
                                    <ol id="students" class="collapse">
                                        <li><a class="btn btn-dark" href="{{ route('student-admit.index') }}">Admit
                                                Students</a></li>
                                        <li><a class="btn btn-dark" href="{{ route('student-list.index') }}">Student
                                                List</a></li>
                                        <li><a class="btn btn-dark" href="{{ route('enrollments.index') }}">Enroll
                                                Students</a></li>
                                        <li><a class="btn btn-dark"
                                                href="{{ route('student-requirements.index') }}">Student Credentials</a>
                                        </li>
                                    </ol>
                                </li>
                                <li class="nav-item">
                                    <div class="btn btn-dark" data-bs-toggle="collapse" data-bs-target="#info">
                                        <img src="{{ asset('svg/form.svg') }}" alt="logo">
                                        Information
                                    </div>
                                    <ol id="info" class="collapse">
                                        <li><a class="btn btn-dark" href="{{ route('schoolyear.index') }}">Year</a></li>
                                        <li><a class="btn btn-dark" href="{{ route('grade-level.index') }}">Grade
                                                Levels</a></li>
                                        <li><a class="btn btn-dark" href="{{ route('sections.index') }}">Sections</a>
                                        </li>
                                        <li><a class="btn btn-dark"
                                                href="{{ route('requirements.index') }}">Requirements</a></li>
                                    </ol>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('billings.index') }}" class="btn btn-dark">
                                        <img src="{{ asset('svg/billing.svg') }}" alt="logo">
                                        Manage Bills
                                    </a>
                                </li>
                            @else
                                @hasanyrole('Student')
                                    <li class="nav-item">
                                        <a href="{{ route('students.dashboard', Auth::user()) }}" class="btn btn-dark">
                                            <img src="{{ asset('svg/dashboard.svg') }}" alt="logo">
                                            Dashboard
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('students.form', Auth::user()) }}" class="btn btn-dark">
                                            <img src="{{ asset('svg/enrollment-form.svg') }}" alt="logo">
                                            Enrollment Form
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('students.credentials') }}" class="btn btn-dark">
                                            <img src="{{ asset('svg/certificate.svg') }}" alt="logo">
                                            Credentials
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('students.bills') }}" class="btn btn-dark">
                                            <img src="{{ asset('svg/billing.svg') }}" alt="logo">
                                            Bills
                                        </a>
                                    </li>
                                @endhasanyrole
                            @endhasanyrole
                        </ol>
                    </div>
                </div>
                <!-- Toggable Responsive Side Menu ends Here  -->

                @yield('content')
                <!-- Main content here -->

                <!-- End of Main content here -->
            </main>
        </div>
    </div>
</body>

</html>
