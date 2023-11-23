@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('enrollments.store')}}" method="POST">
            @csrf
            <div class="border border-2 border-dark rounded my-3 pt-3 p-3">
                <h3 class="fw-bolder text-center">CREATE REQUIREMENTS</h3>
                <div>
                    <!-- Hidden Input -->
                    <input type="text" name="student" value="{{ $student->id }}" hidden>
                    <input type="text" name="schoolyear" value="{{ $latestSchoolYear->id }}" hidden>
                </div>
                <div class="row mt-5">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Student Name</span>
                        <input class="form-control @error('student_id') is-invalid @enderror" type="text"
                            value="{{ $student->firstname }} {{ $student->lastname }}" disabled>
                    </div>
                    <div class="col-md mt-1"></div>
                    <div class="col-md mt-1"></div>
                </div>
                <div class="row mt-5">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Grade and Section<span style="color: red;"> *</span></span>
                        <select class="form-select @error('section') is-invalid @enderror" name="section">
                            <option disabled selected></option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->grade_level->code }} - {{ $section->code }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Enrollment Status<span style="color: red;"> *</span></span>
                        <select class="form-select @error('enrollment_status') is-invalid @enderror" name="enrollment_status">
                            <option selected></option>
                            <option value="admitted">Admitted</option>
                            <option value="enrolled">Enrolled</option>
                            <option value="pending">Pending</option>
                            <option value="not_enrolled">Not Enrolled</option>
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
                        <a class="btn btn-danger" href="{{ route('enrollments.show', ['student' => $student->id]) }}">CANCEL</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
