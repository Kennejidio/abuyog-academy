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
        <h3 class="fw-bolder text-center">SHOW STUDENT BILLS</h3>
        <hr>
        <div class="container mt-1">
            <span class="fw-bolder fs-5">STUDENT: </span>
            <span class="fs-5">{{ $student->firstname }} </span>
            <span class="fs-5">{{ $student->lastname }}</span>
            <div>
                <span class="fw-bolder fs-5">STUDENT ID: </span>
                <span class="fs-5">{{ $student->student_id }}</span>
            </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2">
            <a class="btn" href="{{ route('billings.create', ['student' => $student->id]) }}">
                <img src="{{ asset('svg/plus.svg') }}" alt="Add">
            </a>
        </div>
        <div class="table-responsive-sm overflow-scroll">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>School Year</th>
                        <th>Bill Name</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Amount Paid</th>
                        <th>Billing Status</th>
                        <th>Date of Payment</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($billings as $billing)
                        <tr>
                            <td>{{ $billing->schoolyear->start_year }} - {{ $billing->schoolyear->end_year }}</td>
                            <td>{{ $billing->code }}</td>
                            <td>{{ $billing->description }}</td>
                            <td>{{ $billing->amount }}</td>
                            <td>{{ $billing->amount_paid }}</td>
                            <td>{{ $billing->billing_status }}</td>
                            <td>{{ $billing->payment_date }}</td>
                            <td>
                                <form action="{{ route('billings.destroy', ['billing' => $billing->id]) }}" method="POST">
                                    <a class="btn" href="{{ route('billings.edit', ['billing' => $billing->id]) }}">
                                        <img src="{{ asset('svg/pen.svg') }}" alt="Edit">
                                    </a>

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn"
                                        onclick="return confirm('Are you sure you want to delete this Bill?')">
                                        <img src="{{ asset('svg/trash.svg') }}" alt="Delete">
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! $billings->render() !!}
    </div>
    <div class="row mt-2">
        <div class="col-md text-center">
            <div class="btn-group" role="group" aria-label="Basic example">
                {{-- <button type="submit" class="btn btn-success">UPDATE</button> --}}
                <a class="btn btn-primary" href="{{ route('billings.index') }}">BACK</a>
            </div>
        </div>
    </div>
@endsection
