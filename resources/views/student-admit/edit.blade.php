@extends('layouts.app')

@section('content')
    <div class="container mt-2">
        <form action="{{ route('student-admit.update', $temporaryStudent->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="p-3 border border-2 border-dark rounded">
                <h3 class="fw-bolder text-center">STUDENT PROFILE</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Name -->
                <div class="row mt-5">
                    <h4 class="fw-bold">Name</h4>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Given Name<span style="color: red;"> *</span></span>
                        <input class="form-control" type="text" name="firstname"
                            value="{{ $temporaryStudent->firstname }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Middle Name</span>
                        <input class="form-control" type="text" name="middlename"
                            value="{{ $temporaryStudent->middlename }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Surname Name<span style="color: red;"> *</span></span>
                        <input class="form-control" type="text" name="lastname"
                            value="{{ $temporaryStudent->lastname }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Extension Name</span>
                        <input class="form-control" type="text" name="extname" value="{{ $temporaryStudent->extname }}">
                    </div>
                    <div class="col-md mt-1"></div>
                    <div class="col-md mt-1"></div>
                </div>
                <div class="row mt-4">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Birthdate<span style="color: red;"> *</span></span>
                        <input class="form-control" type="date" name="birthdate"
                            value="{{ $temporaryStudent->birthdate }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Gender<span style="color: red;"> *</span></span>
                        {{-- <input class="form-control" type="text" name="sex" value="{{ $temporaryStudent->sex }}"> --}}
                        <select class="form-select" name="sex">
                            <option value="male" {{ $temporaryStudent->sex == 'male' ? 'selected' : '' }}>male</option>
                            <option value="female" {{ $temporaryStudent->sex == 'female' ? 'selected' : '' }}>female
                            </option>
                            <option value="undefined" {{ $temporaryStudent->sex == 'undefined' ? 'selected' : '' }}>undefined
                            </option>
                        </select>
                    </div>
                    <div class="col-md mt-1"></div>
                </div>
                <div class="row mt-4">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Learners Reference Number<span style="color: red;"> *</span></span>
                        <input class="form-control" type="text" name="learners_reference_number"
                            value="{{ $temporaryStudent->learners_reference_number }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Name of Elementary School Graduated<span style="color: red;">
                                *</span></span>
                        <input class="form-control" type="text" name="last_elementary_school"
                            value="{{ $temporaryStudent->last_elementary_school }}">
                    </div>
                    <div class="col-md mt-1"></div>
                </div>
                <!-- Address -->
                <div class="row mt-5">
                    <h4 class="fw-bold">Address</h4>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Street or House Number</span>
                        <input class="form-control" type="text" name="street" value="{{ $temporaryStudent->street }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Barangay<span style="color: red;"> *</span></span>
                        <input class="form-control" type="text" name="barangay"
                            value="{{ $temporaryStudent->barangay }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Municipal<span style="color: red;"> *</span></span>
                        <input class="form-control" type="text" name="municipal"
                            value="{{ $temporaryStudent->municipal }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Province<span style="color: red;"> *</span></span>
                        <input class="form-control" type="text" name="province"
                            value="{{ $temporaryStudent->province }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Postal Code / Zip Code<span style="color: red;"> *</span></span>
                        <input class="form-control" type="text" name="zip_code"
                            value="{{ $temporaryStudent->zip_code }}">
                    </div>
                    <div class="col-md mt-1"></div>
                </div>
                <!-- Parents -->
                <div class="row mt-5">
                    <h4 class="fw-bold">Parents</h4>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Mother's Name<span style="color: red;"> *</span></span>
                        <input class="form-control" type="text" name="mother_name"
                            value="{{ $temporaryStudent->mother_name }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Father's Name</span>
                        <input class="form-control" type="text" name="father_name"
                            value="{{ $temporaryStudent->father_name }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Guardian's Name</span>
                        <input class="form-control" type="text" name="guardian_name"
                            value="{{ $temporaryStudent->guardian_name }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Parent or Guardian Contact Number<span style="color: red;">
                                *</span></span>
                        <input class="form-control" type="text" name="emergency_contact_number"
                            value="{{ $temporaryStudent->emergency_contact_number }}">
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
                            value="{{ $temporaryStudent->last_grade_level_completed }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Last School Year Completed<span style="color: red;"> *</span></span>
                        <input class="form-control" type="text" name="last_school_year_completed"
                            value="{{ $temporaryStudent->last_school_year_completed }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Last School Attended (For Balik Aral)<span style="color: red;">
                                *</span></span>
                        <input class="form-control" type="text" name="last_school_name"
                            value="{{ $temporaryStudent->last_school_name }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">School Address of last school attended<span style="color: red;">
                                *</span></span>
                        <input class="form-control" type="text" name="last_school_address"
                            value="{{ $temporaryStudent->last_school_address }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">School ID of last school attended<span style="color: red;">
                                *</span></span>
                        <input class="form-control" type="text" name="last_school_id"
                            value="{{ $temporaryStudent->last_school_id }}">
                    </div>
                    <div class="col-md mt-1"></div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md text-center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="submit" class="btn btn-success">SAVE</button>
                        <a class="btn btn-danger" href="{{ url('/student-admit') }}">CANCEL</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <br>
@endsection
