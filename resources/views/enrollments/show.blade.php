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
        <h3 class="fw-bolder text-center">SHOW STUDENT ENROLLMENT</h3>
        <hr>
        <div class="container mt-1">
            <span class="fw-bolder fs-5">STUDENT: </span>
            <span class="fs-5">{{ $student->firstname }} </span>
            <span class="fs-5">{{ $student->lastname }}</span>
            <div>
                <span class="fw-bolder fs-5">STUDENT ID: </span>
                <span class="fs-5">{{ $student->student_id }}</span>
            </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2">
            <a class="btn" href="{{ route('enrollments.create', ['student' => $student->id]) }}">
                <img src="{{ asset('svg/plus.svg') }}" alt="Add">
            </a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>School Year</th>
                    <th>Status</th>
                    <th>Grade/Section</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($enrollments as $enrollment)
                    <tr>
                        <td>{{ $enrollment->enroll_date }}</td>
                        <td>{{ $enrollment->schoolyear->start_year}} - {{ $enrollment->schoolyear->end_year }}</td>
                        <td>{{ $enrollment->enrollment_status }}</td>
                        <td>{{ $enrollment->section->grade_level->code }} {{ $enrollment->section->code }}</td>
                        <td>
                            <form
                                action="{{ route('enrollments.destroy', ['enrollment' => $enrollment->id]) }}"
                                method="POST">
                                <a class="btn"
                                    href="{{ route('enrollments.edit', ['enrollment' => $enrollment->id]) }}">
                                    <img src="{{ asset('svg/pen.svg') }}" alt="Edit">
                                </a>

                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn"
                                    onclick="return confirm('Are you sure you want to delete this Enrollment data?')">
                                    <img src="{{ asset('svg/trash.svg') }}" alt="Delete">
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $enrollments->render() !!}
    </div>
    <div class="row mt-2">
        <div class="col-md text-center">
            <div class="btn-group" role="group" aria-label="Basic example">
                {{-- <button type="submit" class="btn btn-success">UPDATE</button> --}}
                <a class="btn btn-primary" href="{{ route('student-requirements.index') }}">BACK</a>
            </div>
        </div>
    </div>
@endsection
