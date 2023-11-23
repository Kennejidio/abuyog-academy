@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('requirements.update', $requirement->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="border border-2 border-dark rounded my-3 pt-3 p-3">
                <h3 class="fw-bolder text-center">EDIT REQUIREMENTS</h3>
                <div class="row mt-5">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Requirement Name<span style="color: red;"> *</span></span>
                        <input class="form-control @error('code') is-invalid @enderror" type="text"
                            name="code" value="{{ $requirement->code }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Description<span style="color: red;"> *</span></span>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" cols="30"
                            rows="1">{{ $requirement->description }}</textarea>
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
                        <button type="submit" class="btn btn-success">UPDATE</button>
                        <a class="btn btn-danger" href="{{ route('requirements.index') }}">CANCEL</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
