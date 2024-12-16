@extends('admins.layouts.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Payment List</h1>
        </div>

        {{-- list --}}
        <div class="">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body shadow-sm">
                            <form action="{{ route('payment.store') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="account_number" class="form-label">Account Number</label>
                                    <input type="text" name="account_number" id="account_number"
                                        class="form-control @error('account_number')
                                        is-invalid
                                    @enderror"
                                        value="{{ old('account_number') }}" placeholder="Enter Account Number">
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
                                        value="{{ old('account_name') }}" placeholder="Enter Account Name">
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
                                        value="{{ old('type') }}" placeholder="Enter Account Type">
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
                <div class="col">
                    <table class="table">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>ID</th>
                                <th>Account Number</th>
                                <th>Account Name</th>
                                <th>Account Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->id }}</td>
                                    <td>{{ $payment->account_number }}</td>
                                    <td>{{ $payment->account_name }}</td>
                                    <td>{{ $payment->type }}</td>
                                    <td>
                                        <a href="{{ route('payment.edit', $payment->id) }}"
                                            class="btn btn-secondary btn-sm">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="{{ route('payment.destroy', $payment->id) }}"
                                            class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <span class="d-flex justify-content-end">
                        {{ $payments->links() }}
                    </span>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
