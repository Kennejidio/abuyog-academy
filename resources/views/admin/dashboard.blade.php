@extends('layouts.app')

@section('content')
<div class="container border border-2 border-dark rounded my-3 pt-3">
    <div class="h1 text-center">
        Dashboard
    </div>
    <hr>
    <!-- Cards and status -->
    <div class="row">
        <div class="col-md-6 my-3">
            <div class="card text-center">
                <div class="card-header fw-bolder">Enrollment Report</div>
                <div class="card-body">
                    <h5 class="card-title">Enrolled: {{ $enrolledStudents }}</h5>
                    <h5 class="card-title">Temporary: {{ $temporaryStudents }}</h5>
                    <h5 class="card-title">Admitted: {{ $admittedStudents }}</h5>
                    <h5 class="card-title">Not Enrolled: {{ $notOfficialStudents }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-6 my-3">
            <div class="card text-center">
                <div class="card-header fw-bolder">Student Population</div>
                <div class="card-body">
                    <h5 class="card-title">Male: {{ $maleStudents }}</h5>
                    <h5 class="card-title">Female: {{ $femaleStudents }}</h5>
                    <h5 class="card-title">Undefined: {{ $undefinedStudents }}</h5>
                    <h5 class="card-title">Total Students: {{ $totalStudents }}</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Card and status -->
</div>
@endsection
