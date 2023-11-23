@extends('layouts.app')

@section('content')
    <div class="container border border-2 border-dark rounded my-3 pt-3">
        <div>
            <h3 class="fw-bolder text-center">LIST OF STUDENT</h3>
        </div>
        <hr>
        @if (session('success'))
            <script>
                window.onload = function() {
                    alert("{{ session('success') }}");
                }
            </script>
        @endif
        <!-- Add the search form -->
        <form action="{{ route('student-list.search') }}" method="GET" class="my-3">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."
                    value="{{ $searchQuery ?? '' }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
        <div class="table-responsive-sm overflow-scroll mt-5">
            @if ($students->count() > 0)
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Enrollment Status</th>
                            <!-- Add other columns you want to display -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->student_id }}</td>
                                <td>{{ $student->firstname }} {{ $student->lastname }}</td>
                                <td>{{ $student->enrollment_status }}</td>
                                <!-- Display other temporary student fields -->
                                <td>
                                    <a class="btn" href="{{ route('student-list.show', $student->id) }}">
                                        <img src="{{ asset('svg/eye.svg') }}" alt="Show">
                                    </a>
                                    <a class="btn" href="{{ route('student-list.edit', $student->id) }}">
                                        <img src="{{ asset('svg/pen.svg') }}" alt="Edit">
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
        {!! $students->links() !!}
    @else
        <p class="text-center">No temporary students found.</p>
        @endif
    </div>
@endsection
