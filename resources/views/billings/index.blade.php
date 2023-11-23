@extends('layouts.app')

@section('content')
    <div class="container border border-2 border-dark rounded my-3 pt-3">
        @if (session('success'))
            <script>
                window.onload = function() {
                    alert("{{ session('success') }}");
                }
            </script>
        @endif
        <h3 class="fw-bolder text-center">STUDENT BILLING</h3>
        <hr>
        <form action="{{ route('student-requirements.index') }}" method="GET">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."
                    value="{{ $searchQuery ?? '' }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
        <div class="table-responsive-sm overflow-scroll">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Full Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->student_id }}</td>
                            <td>{{ $student->firstname }} {{ $student->lastname }}</td>
                            <td>
                                <a class="btn" href="{{ route('billings.show', ['student' => $student->id]) }}">
                                    <img src="{{ asset('svg/eye.svg') }}" alt="Show">
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! $students->render() !!}
    </div>
@endsection
