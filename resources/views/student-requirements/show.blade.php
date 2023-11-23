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
        <h3 class="fw-bolder text-center">SHOW STUDENT REQUIREMENTS</h3>
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
            <a class="btn" href="{{ route('student-requirements.create', ['student' => $student->id]) }}">
                <img src="{{ asset('svg/plus.svg') }}" alt="Add">
            </a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Requirement Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($studentRequirements as $studentRequirement)
                    <tr>
                        <td>{{ $studentRequirement->requirement->code }}</td>
                        <td>{{ $studentRequirement->requirement_status }}</td>
                        <td>
                            <form
                                action="{{ route('student-requirements.destroy', ['studentRequirement' => $studentRequirement->id]) }}"
                                method="POST">
                                <a class="btn"
                                    href="{{ route('student-requirements.edit', ['studentRequirement' => $studentRequirement->id]) }}">
                                    <img src="{{ asset('svg/pen.svg') }}" alt="Edit">
                                </a>

                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn"
                                    onclick="return confirm('Are you sure you want to delete this requirement?')">
                                    <img src="{{ asset('svg/trash.svg') }}" alt="Delete">
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $studentRequirements->render() !!}
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
