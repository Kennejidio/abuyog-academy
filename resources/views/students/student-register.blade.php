@extends('layouts.auth-app')

@section('content')
    <div class="container mb-3">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-dark">
                        <img src="{{ asset('images/aa-icon.png') }}" alt="icon" width="25" height="25" class="me-3">
                        <span class="text-light fw-bolder">{{ __('Register Form') }}</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('student.store') }}">
                            @csrf
                            <!-- Name and email -->

                            <div class="row mb-3">
                                <label for="firstname"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Firstname') }}</label>

                                <div class="col-md-6">
                                    <input id="firstname" type="text"
                                        class="form-control rounded-pill @error('firstname') is-invalid @enderror"
                                        name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname"
                                        autofocus>

                                    @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="middlename"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Middlename') }}</label>

                                <div class="col-md-6">
                                    <input id="middlename" type="text"
                                        class="form-control rounded-pill @error('middlename') is-invalid @enderror"
                                        name="middlename" value="{{ old('middlename') }}" autocomplete="middlename"
                                        autofocus>

                                    @error('middlename')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="lastname"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Lastname') }}</label>

                                <div class="col-md-6">
                                    <input id="lastname" type="text"
                                        class="form-control rounded-pill @error('lastname') is-invalid @enderror"
                                        name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname"
                                        autofocus>

                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="extname"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Extension Name') }}</label>

                                <div class="col-md-6">
                                    <input id="extname" type="text"
                                        class="form-control rounded-pill @error('extname') is-invalid @enderror"
                                        name="extname" value="{{ old('extname') }}" placeholder="example (jr, III, sr)"
                                        autocomplete="extname" autofocus>

                                    @error('extname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="contact_number"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Mobile Number') }}</label>

                                <div class="col-md-6">
                                    <input id="contact_number" type="tel"
                                        class="form-control rounded-pill @error('contact_number') is-invalid @enderror"
                                        name="contact_number" value="{{ old('contact_number') }}" pattern="[0][9][0-9]{9}"
                                        maxlength="11" required autocomplete="contact_number" autofocus
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">

                                    @error('contact_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control rounded-pill @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Passwords -->
                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control rounded-pill @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control rounded-pill"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-danger rounded-pill">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
