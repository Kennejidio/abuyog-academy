@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('student-requirements.update', ['studentRequirement' => $studentRequirement->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="border border-2 border-dark rounded my-3 pt-3 p-3">
                <h3 class="fw-bolder text-center">EDIT REQUIREMENTS</h3>
                <div class="row mt-5">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Student Name</span>
                        <input class="form-control @error('student_id') is-invalid @enderror" type="text"
                            value="{{ $studentRequirement->student->firstname }} {{ $studentRequirement->student->lastname }}" disabled>
                    </div>
                    <div class="col-md mt-1"></div>
                    <div class="col-md mt-1"></div>
                </div>
                <div class="row mt-5">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Requirement List<span style="color: red;"> *</span></span>
                        <select class="form-select @error('requirement') is-invalid @enderror" name="requirement">
                            <option value="{{ $studentRequirement->requirement_id }}" selected>{{ $studentRequirement->requirement->code }}
                            </option>
                            @foreach ($requirements as $requirement)
                                <option value="{{ $requirement->id }}">{{ $requirement->code }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Requirement Status<span style="color: red;"> *</span></span>
                        <select class="form-select" name="requirement_status">
                            <option value="submitted" {{ $studentRequirement->requirement_status == 'submitted' ? 'selected' : '' }}>Submitted
                            </option>
                            <option value="missing" {{ $studentRequirement->requirement_status == 'missing' ? 'selected' : '' }}>Missing
                            </option>
                            <option value="pending" {{ $studentRequirement->requirement_status == 'pending' ? 'selected' : '' }}>Pending
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
                            href="{{ route('student-requirements.show', ['student' => $studentRequirement->student_id]) }}">CANCEL</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
