@extends('users.layouts.master')

@section('content')
    <div class="container" style="margin-top: 100px">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-5 mb-4">
                                <h5 class="mb-5 text-center">Payment Methods</h5>
                                @foreach ($payments as $payment)
                                    <div class="mb-3">
                                        <strong>{{ $payment->type }}</strong>
                                        <p class="mb-0">Name: {{ $payment->account_name }}</p>
                                        <p>Account: {{ $payment->account_number }}</p>
                                        <hr>
                                    </div>
                                @endforeach
                            </div>

                            <div class="col-lg-7">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0">Payment Info</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('user.order') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="userName" class="form-label">Name</label>
                                                <input type="text" name="user_name" id="userName"
                                                    class="form-control @error('user_name') is-invalid @enderror"
                                                    value="{{ old('user_name', Auth::user()->name) }}" readonly>
                                                @error('user_name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" name="phone" id="phone"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    value="{{ old('phone', Auth::user()->phone) }}"
                                                    placeholder="Enter your phone number">
                                                @error('phone')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="address" class="form-label">Address</label>
                                                <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror"
                                                    placeholder="Enter your address">{{ old('address', Auth::user()->address) }}</textarea>
                                                @error('address')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="payment_method" class="form-label">Payment Method</label>
                                                <select name="payment_method" id="payment_method"
                                                    class="@error('payment_method') is-invalid @enderror form-select">
                                                    <option value="" disabled selected>Select a payment method
                                                    </option>
                                                    @foreach ($payments as $payment)
                                                        <option value="{{ $payment->type }}"
                                                            {{ old('payment_method') == $payment->type ? 'selected' : '' }}>
                                                            {{ $payment->type }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('payment_method')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="order_code" class="form-label">Order Code</label>
                                                <input type="text" name="order_code" id="order_code"
                                                    class="form-control @error('order_code') is-invalid @enderror"
                                                    value="{{ $orderProducts[0]['order_code'] }}" readonly>
                                                @error('order_code')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="total_amt" class="form-label">Total Amount</label>
                                                <input type="text" name="total_amt" id="total_amt"
                                                    class="form-control @error('total_amt') is-invalid @enderror"
                                                    value="{{ $orderProducts[0]['total_amt'] }}" readonly>
                                                @error('total_amt')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="payslip_image" class="form-label">Upload Payslip</label>
                                                <input type="file" name="payslip_image" id="payslip_image"
                                                    class="form-control @error('payslip_image') is-invalid @enderror">
                                                @error('payslip_image')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary btn-block">
                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                    Order Now
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
