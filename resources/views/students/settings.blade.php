@extends('layouts.app')

@section('content')
    @if (session('success'))
        <script>
            window.onload = function() {
                alert("{{ session('success') }}");
            }
        </script>
    @endif

    <h1>Change Password</h1>
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('students.updatePassword') }}">
        @csrf
        <div>
            <label for="current_password">Current Password</label>
            <input class="form-control @error('password') is-invalid @enderror" type="password" name="current_password"
                required>
        </div>
        <div>
            <label for="new_password">New Password</label>
            <input class="form-control @error('new_password') is-invalid @enderror" type="password" name="new_password" required>
        </div>
        <div>
            <label for="new_password_confirmation">Confirm New Password</label>
            <input class="form-control @error('new_password_confirmation') is-invalid @enderror" type="password" name="new_password_confirmation" required>
        </div>
        <button class="btn btn-danger" type="submit">Change Password</button>
    </form>
@endsection
