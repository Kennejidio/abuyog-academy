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
        <h3 class="fw-bolder text-center">SECTION LIST</h3>
        <hr>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2">
            <a class="btn" href="{{ route('sections.create') }}">
                <img src="{{ asset('svg/plus.svg') }}" alt="Add">
            </a>
        </div>
        <div class="table-responsive-sm overflow-scroll">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Section Name</th>
                        <th>Grade Level</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sections as $section)
                        <tr>
                            <td>{{ $section->code }}</td>
                            <td>GRADE {{ $section->grade_level->code }}</td>
                            <td>
                                <form action="{{ route('sections.destroy', $section->id) }}" method="POST">
                                    <a class="btn" href="{{ route('sections.edit', $section->id) }}">
                                        <img src="{{ asset('svg/pen.svg') }}" alt="Edit">
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn" type="submit"
                                        onclick="return confirm('Are you sure to delete SECTION {{ $section->code }}?')">
                                        <img src="{{ asset('svg/trash.svg') }}" alt="Delete">
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! $sections->render() !!}
    </div>
@endsection
