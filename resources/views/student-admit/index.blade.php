@extends('layouts.app')

@section('content')
    <div class="container border border-2 border-dark rounded my-3 pt-3">
        <div>
            <h3 class="fw-bolder text-center">LIST OF STUDENT FOR ADMISSION</h3>
        </div>
        <hr>
        @if (session('success'))
            <script>
                window.onload = function() {
                    alert("{{ session('success') }}");
                }
            </script>
        @endif
        <!-- Add the search form -->
        <form action="{{ route('student-admit.search') }}" method="GET" class="my-3">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."
                    value="{{ $searchQuery ?? '' }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
        <div class="table-responsive-sm overflow-visible mt-5">
            @if ($temporaryStudents->count() > 0)
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <!-- Add other columns you want to display -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($temporaryStudents as $temporaryStudent)
                            <tr>
                                <td>{{ $temporaryStudent->firstname }} {{ $temporaryStudent->lastname }}</td>
                                <td>{{ $temporaryStudent->user->email }}</td>
                                <!-- Display other temporary student fields -->
                                <td>
                                    <a class="btn" href="{{ route('student-admit.show', $temporaryStudent->id) }}">
                                        <img src="{{ asset('svg/eye.svg') }}" alt="Show">
                                    </a>
                                    <a class="btn" href="{{ route('student-admit.edit', $temporaryStudent->id) }}">
                                        <img src="{{ asset('svg/pen.svg') }}" alt="Edit">
                                    </a>
                                    <a href="{{ route('student-admit.admit', $temporaryStudent->id) }}"
                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to admit this student?')) { document.getElementById('admit-form-{{ $temporaryStudent->id }}').submit(); }">
                                        <img src="{{ asset('svg/approval.svg') }}" alt="Admit">
                                    </a>

                                    <form id="admit-form-{{ $temporaryStudent->id }}"
                                        action="{{ route('student-admit.admit', $temporaryStudent->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
        {!! $temporaryStudents->links() !!}
    @else
        <p class="text-center">No temporary students found.</p>
        @endif
    </div>
@endsection
