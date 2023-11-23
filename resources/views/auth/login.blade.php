@extends('layouts.auth-app')

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <script>
                window.onload = function() {
                    alert("{{ session('success') }}");
                }
            </script>
        @endif
        <div class="row">
            <div class="col-sm-8 px-0 d-none d-sm-block">
                <img src="{{ asset('images/aa-bg.png') }}" alt="AA background" class="w-100 vh-100"
                    style="object-fit: cover; object-position: right;">
                <a href="{{ url('/') }}"
                    class="centered text-white h3 shadow text-decoration-none p-2 rounded"><b>{{ config('app.name') }}
                        Inc.</b></a>
            </div>
            <div class="col-sm-4">
                <div class="text-center px-5 pt-5">
                    <img src="{{ asset('images/aa-icon.png') }}" alt="Icon" width="90" height="90"><br><br>
                    <h2>Online Enrollment and Billing System</h2>
                </div>
                <form method="POST" action="{{ route('login') }}" class="mx-auto p-4">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control rounded-pill @error('email') is-invalid @enderror"
                            name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control rounded-pill @error('password') is-invalid @enderror"
                            id="exampleInputPassword1" placeholder="Enter Password" name="password" required
                            autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="exampleCheck1">Remember me</label><br>
                                <p>No account? <a href="{{ route('student.student-register') }}">Sign up</a></p>
                            </div>
                        </div>
                        <div class="col-lg-6 d-grid gap-2 py-3">
                            <button type="submit" class="btn btn-danger rounded-pill btn-block">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
