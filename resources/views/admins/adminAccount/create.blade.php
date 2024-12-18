@extends('admins.layouts.master')

@section('content')
    <div class="container">
        <div class="row p-3">
            <div class="card col-6 offset-3 p-3 shadow-sm">
                <div class="d-flex justify-content-end mb-2">
                    <a href="{{ route('admin.list') }}" class="btn btn-danger"><i class="fa-solid fa-users"></i> Admin List</a>
                </div>
                <div class="card-title bg-dark h-5 p-3 text-center text-white">
                    New Admin Account
                </div>
                <form action="{{ route('addAdmin.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="name" value="{{ old('name') }}" placeholder="Enter Name...">
                            @error('name')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" value="{{ old('email') }}" placeholder="Enter Email">
                            @error('email')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label"> Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" id="password"
                                placeholder="Enter Password">
                            @error('password')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Repeat your password</label>
                            <input type="password" name="confirmPassword"
                                class="form-control @error('confirmPassword') is-invalid @enderror" id="confirm_password"
                                placeholder="Confirm Your Password">
                            @error('confirmPassword')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100 rounded shadow-sm">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
