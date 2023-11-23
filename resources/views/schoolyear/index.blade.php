@extends('layouts.app')

@section('content')
    <div class="container border border-2 border-dark rounded my-3 pt-3">
        @if (session('success'))
            <script>
                window.onload = function() {
                    alert("{{ session('success') }}");
                }
            </script>
        @endif
        <h3 class="fw-bolder text-center">SCHOOL YEAR LIST</h3>
        <hr>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2">
            <a class="btn" href="{{ route('schoolyear.create') }}">
                <img src="{{ asset('svg/plus.svg') }}" alt="Add">
            </a>
        </div>
        <div class="table-responsive-sm overflow-scroll">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>School Year</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schoolyears as $schoolyear)
                        <tr>
                            <td>SY: {{ $schoolyear->start_year }} - {{ $schoolyear->end_year }}</td>
                            <td>
                                <form action="{{ route('schoolyear.destroy', $schoolyear->id) }}" method="POST">
                                    <a class="btn" href="{{ route('schoolyear.edit', $schoolyear->id) }}">
                                        <img src="{{ asset('svg/pen.svg') }}" alt="Edit">
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn" type="submit"
                                        onclick="return confirm('Are you sure to delete SY: {{ $schoolyear->start_year }} - {{ $schoolyear->end_year }}?')">
                                        <img src="{{ asset('svg/trash.svg') }}" alt="Delete">
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! $schoolyears->render() !!}
    </div>
@endsection
