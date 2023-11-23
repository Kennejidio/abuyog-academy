@extends('layouts.app')

@section('content')
    <div class="container mt-2">
        <div class="p-3 border border-2 border-dark rounded">
            <h3 class="fw-bolder text-center">STUDENT PROFILE</h3>
            <!-- Display the success message in a popout dialog -->
            @if (session('success'))
                <script>
                    window.onload = function() {
                        alert("{{ session('success') }}");
                    }
                </script>
            @endif
            <!-- Name -->
            <div class="row mt-5">
                <h4 class="fw-bold">Name</h4>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Given Name<span style="color: red;"> *</span></span>
                    <input class="form-control" type="text" name="firstname"
                        @if ($temporaryStudent) value="{{ $temporaryStudent->firstname }}" @elseif ($student) value="{{ $student->firstname }}" @endif
                        disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Middle Name</span>
                    <input class="form-control" type="text" name="middlename"
                        @if ($temporaryStudent) value="{{ $temporaryStudent->middlename }}" @elseif ($student) value="{{ $student->middlename }}" @endif
                        disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Surname Name<span style="color: red;"> *</span></span>
                    <input class="form-control" type="text" name="lastname"
                        @if ($temporaryStudent) value="{{ $temporaryStudent->lastname }}" @elseif ($student) value="{{ $student->lastname }}" @endif
                        disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-md mt-1">
                    <span class="fw-bolder">Extension Name</span>
                    <input class="form-control" type="text" name="extname"
                        @if ($temporaryStudent) value="{{ $temporaryStudent->extname }}" @elseif ($student) value="{{ $student->extname }}" @endif
                        disabled>
                </div>
                <div class="col-md mt-1"></div>
                <div class="col-md mt-1"></div>
            </div>
            <div class="row mt-4">
                <div class="col-md mt-1">
                    <span class="fw-bolder">Birthdate<span style="color: red;"> *</span></span>
                    <input class="form-control" type="text" name="birthdate"
                        @if ($temporaryStudent) value="{{ $temporaryStudent->birthdate }}" @elseif ($student) value="{{ $student->birthdate }}" @endif
                        disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Gender<span style="color: red;"> *</span></span>
                    <input class="form-control" type="text" name="sex"
                        @if ($temporaryStudent) value="{{ $temporaryStudent->sex }}" @elseif ($student) value="{{ $student->sex }}" @endif
                        disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Age</span>
                    <input class="form-control" type="text" name="age"
                        @if ($temporaryStudent) value="{{ $temporaryStudent->age }}" @elseif ($student) value="{{ $student->age }}" @endif
                        disabled>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md mt-1">
                    <span class="fw-bolder">Learners Reference Number<span style="color: red;"> *</span></span>
                    <input class="form-control" type="text" name="learners_reference_number"
                        @if ($temporaryStudent) value="{{ $temporaryStudent->learners_reference_number }}" @elseif ($student) value="{{ $student->learners_reference_number }}" @endif
                        disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Name of Elementary School Graduated<span style="color: red;">
                            *</span></span>
                    <input class="form-control" type="text" name="last_elementary_school"
                        @if ($temporaryStudent) value="{{ $temporaryStudent->last_elementary_school }}" @elseif ($student) value="{{ $student->last_elementary_school }}" @endif
                        disabled>
                </div>
                <div class="col-md mt-1"></div>
            </div>
            <!-- Address -->
            <div class="row mt-5">
                <h4 class="fw-bold">Address</h4>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Street / House Number / Residence</span>
                    <input class="form-control" type="text" name="street"
                        @if ($temporaryStudent) value="{{ $temporaryStudent->street }}" @elseif ($student) value="{{ $student->street }}" @endif
                        disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Barangay<span style="color: red;"> *</span></span>
                    <input class="form-control" type="text" name="barangay"
                        @if ($temporaryStudent) value="{{ $temporaryStudent->barangay }}" @elseif ($student) value="{{ $student->barangay }}" @endif
                        disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Municipal / City<span style="color: red;"> *</span></span>
                    <input class="form-control" type="text" name="municipal"
                        @if ($temporaryStudent) value="{{ $temporaryStudent->municipal }}" @elseif ($student) value="{{ $student->municipal }}" @endif
                        disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-md mt-1">
                    <span class="fw-bolder">Province<span style="color: red;"> *</span></span>
                    <input class="form-control" type="text" name="province"
                        @if ($temporaryStudent) value="{{ $temporaryStudent->province }}" @elseif ($student) value="{{ $student->province }}" @endif
                        disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Postal Code / Zip Code<span style="color: red;"> *</span></span>
                    <input class="form-control" type="text" name="zip"
                        @if ($temporaryStudent) value="{{ $temporaryStudent->zip_code }}" @elseif ($student) value="{{ $student->zip_code }}" @endif
                        disabled>
                </div>
                <div class="col-md mt-1"></div>
            </div>
            <!-- Parents -->
            <div class="row mt-5">
                <h4 class="fw-bold">Parents</h4>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Mother's Name<span style="color: red;"> *</span></span>
                    <input class="form-control" type="text" name="mother_name"
                        @if ($temporaryStudent) value="{{ $temporaryStudent->mother_name }}" @elseif ($student) value="{{ $student->mother_name }}" @endif
                        disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Father's Name</span>
                    <input class="form-control" type="text" name="father_name"
                        @if ($temporaryStudent) value="{{ $temporaryStudent->father_name }}" @elseif ($student) value="{{ $student->father_name }}" @endif
                        disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Guardian's Name</span>
                    <input class="form-control" type="text" name="guardian_name"
                        @if ($temporaryStudent) value="{{ $temporaryStudent->guardian_name }}" @elseif ($student) value="{{ $student->guardian_name }}" @endif
                        disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-md mt-1">
                    <span class="fw-bolder">Parent or Guardian Contact Number<span style="color: red;">
                            *</span></span>
                    <input class="form-control" type="text" name="emergency_contact_number"
                        @if ($temporaryStudent) value="{{ $temporaryStudent->emergency_contact_number }}" @elseif ($student) value="{{ $student->emergency_contact_number }}" @endif
                        disabled>
                </div>
                <div class="col-md mt-1"></div>
                <div class="col-md mt-1"></div>
            </div>
            <!-- Balik Aral -->
            <div class="row mt-5">
                <h4 class="fw-bold">For Returning Learners (Balik-Aral) and those Who Shall Transfer/Move In</h4>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Last Grade Level Completed<span style="color: red;"> *</span></span>
                    <input class="form-control" type="text" name="last_grade_level_completed"
                        @if ($temporaryStudent) value="{{ $temporaryStudent->last_grade_level_completed }}" @elseif ($student) value="{{ $student->last_grade_level_completed }}" @endif
                        disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Last School Year Completed<span style="color: red;"> *</span></span>
                    <input class="form-control" type="text" name="last_school_year_completed"
                        @if ($temporaryStudent) value="{{ $temporaryStudent->last_school_year_completed }}" @elseif ($student) value="{{ $student->last_school_year_completed }}" @endif
                        disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Last School Attended (For Balik Aral)<span style="color: red;">
                            *</span></span>
                    <input class="form-control" type="text" name="last_school_name"
                        @if ($temporaryStudent) value="{{ $temporaryStudent->last_school_name }}" @elseif ($student) value="{{ $student->last_school_name }}" @endif
                        disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-md mt-1">
                    <span class="fw-bolder">School Address of last school attended<span style="color: red;">
                            *</span></span>
                    <input class="form-control" type="text" name="last_school_address"
                        @if ($temporaryStudent) value="{{ $temporaryStudent->last_school_address }}" @elseif ($student) value="{{ $student->last_school_address }}" @endif
                        disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">School ID of last school attended<span style="color: red;">
                            *</span></span>
                    <input class="form-control" type="text" name="last_school_id"
                        @if ($temporaryStudent) value="{{ $temporaryStudent->last_school_id }}" @elseif ($student) value="{{ $student->last_school_id }}" @endif
                        disabled>
                </div>
                <div class="col-md mt-1"></div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md text-center">
                <div class="btn-group" role="group" aria-label="Basic example">
                    @if ($temporaryStudent)
                        <a class="btn btn-primary"
                            href="{{ route('students.edit', ['id' => $temporaryStudent->user_id]) }}">EDIT</a>
                    @else
                        Admitted
                        <br>
                        Note: Once admitted by admin, it cannot be undone, please ask the admin for inqueries.
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection
