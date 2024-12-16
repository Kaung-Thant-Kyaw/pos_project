@extends('admins.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="mb-3">
                    <a href="{{ route('payment.index') }}" class="btn btn-outline-dark">Go Back</a>
                </div>

                <div class="card">
                    <div class="card-body shadow-sm">
                        <form action="{{ route('payment.update', $payment->id) }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="account_number" class="form-label">Account Number</label>
                                <input type="text" name="account_number" id="account_number"
                                    class="form-control @error('account_number')
                                is-invalid
                            @enderror"
                                    value="{{ old('account_number', $payment->account_number) }}"
                                    placeholder="Enter Account Number">
                                @error('account_number')
                                    <small class="invalid-feedback">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="account_name" class="form-label">Account Name</label>
                                <input type="text" name="account_name" id="acount_name"
                                    class="form-control @error('account_name')
                                is-invalid
                            @enderror"
                                    value="{{ old('account_name', $payment->account_name) }}"
                                    placeholder="Enter Account Name">
                                @error('account_name')
                                    <small class="invalid-feedback">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Account Type</label>
                                <input type="text" name="type" id="type"
                                    class="form-control @error('type')
                                is-invalid
                            @enderror"
                                    value="{{ old('type', $payment->type) }}" placeholder="Enter Account Type">
                                @error('type')
                                    <small class="invalid-feedback">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-outline-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
