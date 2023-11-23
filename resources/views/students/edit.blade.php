@extends('layouts.app')

@section('content')
    <div class="container mt-2">
        <form action="{{ route('students.update', ['id' => $temporaryStudent->user_id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="p-3 border border-2 border-dark rounded">
                <h3 class="fw-bolder text-center">EDIT PROFILE</h3>
                <!-- Name -->
                <div class="row mt-5">
                    <h4 class="fw-bold">Name</h4>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Given Name<span style="color: red;"> *</span></span>
                        <input class="form-control @error('firstname') is-invalid @enderror" type="text" name="firstname"
                            @if ($temporaryStudent) value="{{ $temporaryStudent->firstname }}" @elseif ($student) value="{{ $student->firstname }}" @endif>
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Middle Name</span>
                        <input class="form-control" type="text" name="middlename"
                            @if ($temporaryStudent) value="{{ $temporaryStudent->middlename }}" @elseif ($student) value="{{ $student->middlename }}" @endif>
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Surname Name<span style="color: red;"> *</span></span>
                        <input class="form-control @error('lastname') is-invalid @enderror" type="text" name="lastname"
                            @if ($temporaryStudent) value="{{ $temporaryStudent->lastname }}" @elseif ($student) value="{{ $student->lastname }}" @endif>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Extension Name</span>
                        <input class="form-control" type="text" name="extname"
                            @if ($temporaryStudent) value="{{ $temporaryStudent->extname }}" @elseif ($student) value="{{ $student->extname }}" @endif>
                    </div>
                    <div class="col-md mt-1"></div>
                    <div class="col-md mt-1"></div>
                </div>
                <div class="row mt-4">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Birthdate<span style="color: red;"> *</span></span>
                        <input class="form-control @error('birthdate') is-invalid @enderror" type="date" name="birthdate"
                            @if ($temporaryStudent) value="{{ $temporaryStudent->birthdate }}" @elseif ($student) value="{{ $student->birthdate }}" @endif>
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Gender<span style="color: red;"> *</span></span>
                        <select class="form-select @error('sex') is-invalid @enderror" name="sex">
                            <option value="male"
                                @if ($temporaryStudent) {{ $temporaryStudent->sex == 'male' ? 'selected' : '' }} @elseif ($student) {{ $student->sex == 'male' ? 'selected' : '' }} @endif>
                                male</option>
                            <option value="female"
                                @if ($temporaryStudent) {{ $temporaryStudent->sex == 'female' ? 'selected' : '' }} @elseif ($student) {{ $student->sex == 'female' ? 'selected' : '' }} @endif>
                                female</option>
                            <option value="undefined"
                                @if ($temporaryStudent) {{ $temporaryStudent->sex == 'undefined' ? 'selected' : '' }} @elseif ($student) {{ $student->sex == 'undefined' ? 'selected' : '' }} @endif
                                disabled>
                                undefined</option>
                        </select>
                    </div>
                    <div class="col-md mt-1"></div>
                </div>
                <div class="row mt-4">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Learners Reference Number<span style="color: red;"> *</span></span>
                        <input class="form-control @error('learners_reference_number') is-invalid @enderror" type="text"
                            name="learners_reference_number" maxlength="12"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            @if ($temporaryStudent) value="{{ $temporaryStudent->learners_reference_number }}" @elseif ($student) value="{{ $student->learners_reference_number }}" @endif>
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Name of Elementary School Graduated<span style="color: red;">
                                *</span></span>
                        <input class="form-control @error('last_elementary_school') is-invalid @enderror" type="text"
                            name="last_elementary_school"
                            @if ($temporaryStudent) value="{{ $temporaryStudent->last_elementary_school }}" @elseif ($student) value="{{ $student->last_elementary_school }}" @endif>
                    </div>
                    <div class="col-md mt-1"></div>
                </div>
                <!-- Address -->
                <div class="row mt-5">
                    <h4 class="fw-bold">Address</h4>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Street / House Number / Residence</span>
                        <input class="form-control" type="text" name="street"
                            @if ($temporaryStudent) value="{{ $temporaryStudent->street }}" @elseif ($student) value="{{ $student->street }}" @endif>
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Barangay<span style="color: red;"> *</span></span>
                        <input class="form-control @error('barangay') is-invalid @enderror" type="text" name="barangay"
                            @if ($temporaryStudent) value="{{ $temporaryStudent->barangay }}" @elseif ($student) value="{{ $student->barangay }}" @endif>
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Municipal / City<span style="color: red;"> *</span></span>
                        <input class="form-control @error('municipal') is-invalid @enderror" type="text"
                            name="municipal"
                            @if ($temporaryStudent) value="{{ $temporaryStudent->municipal }}" @elseif ($student) value="{{ $student->municipal }}" @endif>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Province<span style="color: red;"> *</span></span>
                        <input class="form-control @error('province') is-invalid @enderror" type="text" name="province"
                            @if ($temporaryStudent) value="{{ $temporaryStudent->province }}" @elseif ($student) value="{{ $student->province }}" @endif>
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Postal Code / Zip Code</span>
                        <input class="form-control" type="text" name="zip_code" maxlength="4"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            @if ($temporaryStudent) value="{{ $temporaryStudent->zip_code }}" @elseif ($student) value="{{ $student->zip_code }}" @endif>
                    </div>
                    <div class="col-md mt-1"></div>
                </div>
                <!-- Parents -->
                <div class="row mt-5">
                    <h4 class="fw-bold">Parents</h4>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Mother's Name<span style="color: red;"> *</span></span>
                        <input class="form-control @error('mother_name') is-invalid @enderror" type="text"
                            name="mother_name"
                            @if ($temporaryStudent) value="{{ $temporaryStudent->mother_name }}" @elseif ($student) value="{{ $student->mother_name }}" @endif>
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Father's Name</span>
                        <input class="form-control" type="text" name="father_name"
                            @if ($temporaryStudent) value="{{ $temporaryStudent->father_name }}" @elseif ($student) value="{{ $student->father_name }}" @endif>
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Guardian's Name</span>
                        <input class="form-control" type="text" name="guardian_name"
                            @if ($temporaryStudent) value="{{ $temporaryStudent->guardian_name }}" @elseif ($student) value="{{ $student->guardian_name }}" @endif>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Parent or Guardian Contact Number<span style="color: red;">
                                *</span></span>
                        <input class="form-control @error('emergency_contact_number') is-invalid @enderror"
                            type="text" name="emergency_contact_number" pattern="[0][9][0-9]{9}" maxlength="11"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            @if ($temporaryStudent) value="{{ $temporaryStudent->emergency_contact_number }}" @elseif ($student) value="{{ $student->emergency_contact_number }}" @endif>
                    </div>
                    <div class="col-md mt-1"></div>
                    <div class="col-md mt-1"></div>
                </div>
                <!-- Balik Aral -->
                <div class="row mt-5">
                    <h4 class="fw-bold">For Returning Learners (Balik-Aral) and those Who Shall Transfer/Move In</h4>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Last Grade Level Completed</span>
                        <input class="form-control" type="text" name="last_grade_level_completed"
                            @if ($temporaryStudent) value="{{ $temporaryStudent->last_grade_level_completed }}" @elseif ($student) value="{{ $student->last_grade_level_completed }}" @endif>
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Last School Year Completed</span>
                        <input class="form-control" type="text" name="last_school_year_completed"
                            @if ($temporaryStudent) value="{{ $temporaryStudent->last_school_year_completed }}" @elseif ($student) value="{{ $student->last_school_year_completed }}" @endif>
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Last School Attended (For Balik Aral)</span>
                        <input class="form-control" type="text" name="last_school_name"
                            @if ($temporaryStudent) value="{{ $temporaryStudent->last_school_name }}" @elseif ($student) value="{{ $student->last_school_name }}" @endif>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">School Address of last school attended</span>
                        <input class="form-control" type="text" name="last_school_address"
                            @if ($temporaryStudent) value="{{ $temporaryStudent->last_school_address }}" @elseif ($student) value="{{ $student->last_school_address }}" @endif>
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">School ID of last school attended</span>
                        <input class="form-control" type="text" name="last_school_id"
                            @if ($temporaryStudent) value="{{ $temporaryStudent->last_school_id }}" @elseif ($student) value="{{ $student->last_school_id }}" @endif>
                    </div>
                    <div class="col-md mt-1"></div>
                </div>
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger my-2">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row mt-2">
                <div class="col-md text-center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="submit" class="btn btn-success">SAVE</button>
                        <a class="btn btn-danger" href="{{ url()->previous() }}">CANCEL</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
