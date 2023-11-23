@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('enrollments.update', ['enrollment' => $enrollment->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="border border-2 border-dark rounded my-3 pt-3 p-3">
                <h3 class="fw-bolder text-center">EDIT ENROLLMENT DATA</h3>
                <div>
                    <input type="text" name="student" value="{{ $enrollment->student_id }}" hidden>
                </div>
                <div class="row mt-5">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Student Name</span>
                        <input class="form-control @error('student_id') is-invalid @enderror" type="text"
                            value="{{ $enrollment->student->firstname }} {{ $enrollment->student->lastname }}" disabled>
                    </div>
                    <div class="col-md mt-1"></div>
                    <div class="col-md mt-1"></div>
                </div>
                <div class="row mt-5">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Requirement List<span style="color: red;"> *</span></span>
                        <select class="form-select @error('section') is-invalid @enderror" name="section">
                            <option value="{{ $enrollment->section_id }}" selected>{{ $enrollment->section->grade_level->code }} {{ $enrollment->section->code }}
                            </option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->grade_level->code }} {{ $section->code }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Requirement Status<span style="color: red;"> *</span></span>
                        <select class="form-select" name="enrollment_status">
                            <option value="admitted" {{ $enrollment->enrollment_status == 'admitted' ? 'selected' : '' }}>Admitted
                            </option>
                            <option value="enrolled" {{ $enrollment->enrollment_status == 'enrolled' ? 'selected' : '' }}>Enrolled
                            </option>
                            <option value="pending" {{ $enrollment->enrollment_status == 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="not_enrolled" {{ $enrollment->enrollment_status == 'not_enrolled' ? 'selected' : '' }}>Not Enrolled
                            </option>
                        </select>
                    </div>
                    <div class="col-md mt-1"></div>
                </div>

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
            </div>
            <div class="row mt-2">
                <div class="col-md text-center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="submit" class="btn btn-success">SUBMIT</button>
                        <a class="btn btn-danger"
                            href="{{ route('enrollments.show', ['student' => $enrollment->student_id]) }}">CANCEL</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
