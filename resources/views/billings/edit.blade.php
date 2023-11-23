@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('billings.update', ['billing' => $billing->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="border border-2 border-dark rounded my-3 pt-3 p-3">
                <h3 class="fw-bolder text-center">EDIT BILL</h3>
                <div class="row mt-5">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Student Name</span>
                        <input class="form-control @error('student_id') is-invalid @enderror" type="text"
                            value="{{ $billing->student->firstname }} {{ $billing->student->lastname }}"
                            disabled>
                    </div>
                    <div class="col-md mt-1"></div>
                    <div class="col-md mt-1"></div>
                </div>
                <div class="row mt-5">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Name of Bill<span style="color: red;"> *</span></span>
                        <input class="form-control @error('requirement') is-invalid @enderror" type="text" name="code"
                            value="{{ $billing->code }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Description<span style="color: red;"> *</span></span>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id=""
                            cols="10" rows="1">{{ $billing->description }}</textarea>
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Amount</span>
                        <input class="form-control @error('amount') is-invalid @enderror" type="number" name="amount"
                            value="{{ $billing->amount }}">
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Paid Amount</span>
                        <input class="form-control @error('amount_paid') is-invalid @enderror" type="number"
                            name="amount_paid" value="{{ $billing->amount_paid }}">
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Billing Status</span>
                        <select class="form-select @error('billing_status') is-invalid @enderror" name="billing_status">
                            <option value="paid" {{ $billing->billing_status == 'paid' ? 'selected' : '' }}>
                                Paid
                            </option>
                            <option value="partially_paid"
                                {{ $billing->billing_status == 'partially_paid' ? 'selected' : '' }}>
                                Partially Paid
                            </option>
                            <option value="unpaid" {{ $billing->billing_status == 'unpaid' ? 'selected' : '' }}>
                                Unpaid
                            </option>
                        </select>
                    </div>
                    <div class="col-md mt-1">
                        <span class="fw-bolder">Date of Payment</span>
                        <input class="form-control @error('payment_date') is-invalid @enderror" type="date"
                            name="payment_date" value="{{ $billing->payment_date }}">
                    </div>
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
                        <button type="submit" class="btn btn-success">SUBMIT</button>
                        <a class="btn btn-danger"
                            href="{{ route('billings.show', ['student' => $billing->student_id]) }}">CANCEL</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
