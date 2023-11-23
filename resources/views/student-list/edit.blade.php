@extends('layouts.app')

@section('content')
    <div class="container mt-2">
        <form action="{{ route('student-list.update', $student->id) }}" method="POST">
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
                            value="{{ $student->firstname }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Middle Name</span>
                        <input class="form-control" type="text" name="middlename" value="{{ $student->middlename }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Surname Name<span style="color: red;"> *</span></span>
                        <input class="form-control @error('lastname') is-invalid @enderror" type="text" name="lastname"
                            value="{{ $student->lastname }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Extension Name</span>
                        <input class="form-control" type="text" name="extname" value="{{ $student->extname }}">
                    </div>
                    <div class="col-md mt-1"></div>
                    <div class="col-md mt-1"></div>
                </div>
                <div class="row mt-4">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Birthdate<span style="color: red;"> *</span></span>
                        <input class="form-control @error('birthdate') is-invalid @enderror" type="date" name="birthdate"
                            ($student) value="{{ $student->birthdate }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Gender<span style="color: red;"> *</span></span>
                        <select class="form-select @error('sex') is-invalid @enderror" name="sex">
                            <option value="male" {{ $student->sex == 'male' ? 'selected' : '' }}>
                                male</option>
                            <option value="female" {{ $student->sex == 'female' ? 'selected' : '' }}>
                                female</option>
                            <option value="undefined" {{ $student->sex == 'undefined' ? 'selected' : '' }} disabled>
                                undefined</option>
                        </select>
                    </div>
                    <div class="col-md mt-1"></div>
                </div>
                <div class="row mt-4">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Learners Reference Number<span style="color: red;"> *</span></span>
                        <input class="form-control @error('learners_reference_number') is-invalid @enderror" type="text"
                            name="learners_reference_number" value="{{ $student->learners_reference_number }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Name of Elementary School Graduated<span style="color: red;">
                                *</span></span>
                        <input class="form-control @error('last_elementary_school') is-invalid @enderror" type="text"
                            name="last_elementary_school" value="{{ $student->last_elementary_school }}">
                    </div>
                    <div class="col-md mt-1"></div>
                </div>
                <!-- Address -->
                <div class="row mt-5">
                    <h4 class="fw-bold">Address</h4>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Street / House Number / Residence</span>
                        <input class="form-control" type="text" name="street" value="{{ $student->street }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Barangay<span style="color: red;"> *</span></span>
                        <input class="form-control @error('barangay') is-invalid @enderror" type="text" name="barangay"
                            value="{{ $student->barangay }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Municipal / City<span style="color: red;"> *</span></span>
                        <input class="form-control @error('municipal') is-invalid @enderror" type="text" name="municipal"
                            value="{{ $student->municipal }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Province<span style="color: red;"> *</span></span>
                        <input class="form-control @error('province') is-invalid @enderror" type="text" name="province"
                            value="{{ $student->province }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Postal Code / Zip Code</span>
                        <input class="form-control" type="text" name="zip_code" value="{{ $student->zip_code }}">
                    </div>
                    <div class="col-md mt-1"></div>
                </div>
                <!-- Parents -->
                <div class="row mt-5">
                    <h4 class="fw-bold">Parents</h4>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Mother's Name<span style="color: red;"> *</span></span>
                        <input class="form-control @error('mother_name') is-invalid @enderror" type="text"
                            name="mother_name" value="{{ $student->mother_name }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Father's Name</span>
                        <input class="form-control" type="text" name="father_name"
                            value="{{ $student->father_name }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Guardian's Name</span>
                        <input class="form-control" type="text" name="guardian_name"
                            value="{{ $student->guardian_name }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Parent or Guardian Contact Number<span style="color: red;">
                                *</span></span>
                        <input class="form-control @error('emergency_contact_number') is-invalid @enderror"
                            type="text" name="emergency_contact_number"
                            value="{{ $student->emergency_contact_number }}">
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
                            value="{{ $student->last_grade_level_completed }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Last School Year Completed</span>
                        <input class="form-control" type="text" name="last_school_year_completed"
                            value="{{ $student->last_school_year_completed }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Last School Attended (For Balik Aral)</span>
                        <input class="form-control" type="text" name="last_school_name"
                            value="{{ $student->last_school_name }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">School Address of last school attended</span>
                        <input class="form-control" type="text" name="last_school_address"
                            value="{{ $student->last_school_address }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">School ID of last school attended</span>
                        <input class="form-control" type="text" name="last_school_id"
                            value="{{ $student->last_school_id }}">
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
