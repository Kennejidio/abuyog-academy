@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('schoolyear.store') }}" method="POST">
            @csrf
            <div class="border border-2 border-dark rounded my-3 pt-3 p-3">
                <h3 class="fw-bolder text-center">ADD SCHOOL YEAR</h3>
                <div class="row mt-5">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Start Year<span style="color: red;"> *</span></span>
                        <input class="form-control @error('start_year') is-invalid @enderror" type="text"
                            name="start_year" pattern="[2][0][0-9]{2}" maxlength="4"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">End Year<span style="color: red;"> *</span></span>
                        <input class="form-control @error('end_year') is-invalid @enderror" type="text" name="end_year"
                            pattern="[2][0][0-9]{2}" maxlength="4"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
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
                        <button type="submit" class="btn btn-success">ADD</button>
                        <a class="btn btn-danger" href="{{ route('schoolyear.index') }}">CANCEL</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
