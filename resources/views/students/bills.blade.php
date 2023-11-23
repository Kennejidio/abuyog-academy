@extends('layouts.app')

@section('content')
<div class="container border border-2 border-dark rounded my-3 pt-3">
    <h3 class="fw-bolder text-center">YOUR BILLS</h3>
    <hr>
    <div class="table-responsive-sm overflow-scroll">
        @if ($bills->isEmpty())
            <div class="alert alert-warning text-center">
                No bills to display.
            </div>
        @else
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bills as $bill)
                        <tr>
                            <td>{{ $bill->schoolyear->start_year }} - {{ $bill->schoolyear->end_year }}</td>
                            <td>{{ $bill->code }}</td>
                            <td>{{ $bill->description }}</td>
                            <td>{{ $bill->amount }}</td>
                            <td>{{ $bill->amount_paid }}</td>
                            <td>{{ $bill->billing_status }}</td>
                            <td>{{ $bill->payment_date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
