@extends('layouts.app')

@section('content')
    <div class="container border border-2 border-dark rounded my-3 pt-3">
        <div class="h1 text-center">
            Dashboard - {{ optional($student)->firstname }} {{ optional($student)->lastname }}
            {{ optional($temporaryStudent)->firstname }} {{ optional($temporaryStudent)->lastname }}
        </div>
        <hr>
        <!-- Cards and status -->
        <div class="row">
            <div class="col-md-6 my-3">
                <div class="card text-center">
                    <div class="card-header fw-bolder">Enrolment Status</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ optional($student)->enrollment_status }}
                            {{ optional($temporaryStudent)->enrollment_status }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6 my-3">
                <div class="card text-center">
                    <div class="card-header fw-bolder">Grade Level and Section</div>
                    <div class="card-body">
                        <h5 class="card-title">List of Enrolled Grades from previous to Latest</h5>
                        @if (empty($enrollments))
                            Nothing to display
                        @else
                            @foreach ($enrollments as $enrollment)
                                <p>Grade {{ $enrollment->section->grade_level->code }} - {{ $enrollment->section->code }} |
                                    @if ($enrollment->section && $enrollment->section->grade_level && $enrollment->schoolyear)
                                        <p>Grade {{ $enrollment->section->grade_level->code }} -
                                            {{ $enrollment->section->code }} |
                                            SY {{ $enrollment->schoolyear->start_year }} -
                                            {{ $enrollment->schoolyear->end_year }}
                                        </p>
                                    @endif
                            @endforeach
                            @if ($enrollments->isEmpty())
                                Nothing to display
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Card and status -->
    </div>
@endsection
