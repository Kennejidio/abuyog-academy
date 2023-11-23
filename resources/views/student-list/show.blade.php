@extends('layouts.app')

@section('content')
    <div class="container mt-2">
        <div class="p-3 border border-2 border-dark rounded">
            <h3 class="fw-bolder text-center">STUDENT PROFILE</h3>
            <!-- Name -->
            <div class="row mt-5">
                <h4 class="fw-bold">Name</h4>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Given Name<span style="color: red;"> *</span></span>
                    <input class="form-control" type="text" name="firstname" value="{{ $student->firstname }}"
                        disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Middle Name</span>
                    <input class="form-control" type="text" name="middlename" value="{{ $student->middlename }}"
                        disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Surname Name<span style="color: red;"> *</span></span>
                    <input class="form-control" type="text" name="lastname" value="{{ $student->lastname }}"
                        disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-md mt-1">
                    <span class="fw-bolder">Extension Name</span>
                    <input class="form-control" type="text" name="extname" value="{{ $student->extname }}"
                        disabled>
                </div>
                <div class="col-md mt-1"></div>
                <div class="col-md mt-1"></div>
            </div>
            <div class="row mt-4">
                <div class="col-md mt-1">
                    <span class="fw-bolder">Birthdate<span style="color: red;"> *</span></span>
                    <input class="form-control" type="date" name="birthdate" value="{{ $student->birthdate }}"
                        disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Gender<span style="color: red;"> *</span></span>
                    <input class="form-control" type="text" name="sex" value="{{ $student->sex }}" disabled>
                </div>
                <div class="col-md mt-1"></div>
            </div>
            <div class="row mt-4">
                <div class="col-md mt-1">
                    <span class="fw-bolder">Learners Reference Number<span style="color: red;"> *</span></span>
                    <input class="form-control" type="text" name="learners_reference_number"
                        value="{{ $student->learners_reference_number }}" disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Name of Elementary School Graduated<span style="color: red;">
                            *</span></span>
                    <input class="form-control" type="text" name="last_elementary_school"
                        value="{{ $student->last_elementary_school }}" disabled>
                </div>
                <div class="col-md mt-1"></div>
            </div>
            <!-- Address -->
            <div class="row mt-5">
                <h4 class="fw-bold">Address</h4>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Street or House Number</span>
                    <input class="form-control" type="text" name="street" value="{{ $student->street }}"
                        disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Barangay<span style="color: red;"> *</span></span>
                    <input class="form-control" type="text" name="barangay" value="{{ $student->barangay }}"
                        disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Municipal<span style="color: red;"> *</span></span>
                    <input class="form-control" type="text" name="municipal" value="{{ $student->municipal }}"
                        disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-md mt-1">
                    <span class="fw-bolder">Province<span style="color: red;"> *</span></span>
                    <input class="form-control" type="text" name="province" value="{{ $student->province }}"
                        disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Postal Code / Zip Code<span style="color: red;"> *</span></span>
                    <input class="form-control" type="text" name="zip_code" value="{{ $student->zip_code }}"
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
                        value="{{ $student->mother_name }}" disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Father's Name</span>
                    <input class="form-control" type="text" name="father_name"
                        value="{{ $student->father_name }}" disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Guardian's Name</span>
                    <input class="form-control" type="text" name="guardian_name"
                        value="{{ $student->guardian_name }}" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-md mt-1">
                    <span class="fw-bolder">Parent or Guardian Contact Number<span style="color: red;">
                            *</span></span>
                    <input class="form-control" type="text" name="emergency_contact_number"
                        value="{{ $student->emergency_contact_number }}" disabled>
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
                        value="{{ $student->last_grade_level_completed }}" disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Last School Year Completed<span style="color: red;"> *</span></span>
                    <input class="form-control" type="text" name="last_school_year_completed"
                        value="{{ $student->last_school_year_completed }}" disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">Last School Attended (For Balik Aral)<span style="color: red;">
                            *</span></span>
                    <input class="form-control" type="text" name="last_school_name"
                        value="{{ $student->last_school_name }}" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-md mt-1">
                    <span class="fw-bolder">School Address of last school attended<span style="color: red;">
                            *</span></span>
                    <input class="form-control" type="text" name="last_school_address"
                        value="{{ $student->last_school_address }}" disabled>
                </div>
                <div class="col-md mt-1">
                    <span class="fw-bolder">School ID of last school attended<span style="color: red;">
                            *</span></span>
                    <input class="form-control" type="text" name="last_school_id"
                        value="{{ $student->last_school_id }}" disabled>
                </div>
                <div class="col-md mt-1"></div>
            </div>
        </div>
        <div class="row mt-2">
            @php
                use Illuminate\Support\Facades\URL;
            @endphp

            <div class="col-md text-center">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a class="btn btn-primary" href="{{ route('student-list.edit', $student->id) }}">EDIT</a>
                    <a class="btn btn-danger" href="{{ URL::previous() }}">BACK</a>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection
