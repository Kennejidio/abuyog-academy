@extends('layouts.app')

@section('content')
    <div class="container border border-2 border-dark rounded my-3 pt-3">
        <h3 class="fw-bolder text-center">YOUR CREDENTIALS</h3>
        <hr>
        <div class="table-responsive-sm overflow-scroll">
            @if ($requirements->isEmpty())
                <div class="alert alert-warning text-center">
                    No student record found.
                </div>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>School Year</th>
                            <th>Credential Name</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requirements as $requirement)
                            <tr>
                                <td>
                                    @if ($requirement->schoolyear)
                                        {{ $requirement->schoolyear->start_year }} -
                                        {{ $requirement->schoolyear->end_year }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $requirement->requirement->code }}</td>
                                <td>{{ $requirement->requirement->description }}</td>
                                <td>{{ $requirement->requirement_status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
        @endif
    @endsection
