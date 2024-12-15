@extends('admins.layouts.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-center text-gray-800">Change Password</h1>
        </div>

        {{-- list --}}
        <div class="">
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="card">
                        <div class="card-body shadow-sm">
                            <form action="{{ route('profile.changePassword') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Old Password</label>
                                    <input type="password" name="oldPassword"
                                        class="form-control @error('oldPassword') is-invalid @enderror"
                                        id="exampleFormControlInput1" placeholder="Enter Old Password">
                                    @error('oldPassword')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">New Password</label>
                                    <input type="password" name="newPassword"
                                        class="form-control @error('newPassword') is-invalid @enderror"
                                        id="exampleFormControlInput1" placeholder="Enter New Password">
                                    @error('newPassword')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Confirm Password</label>
                                    <input type="password" name="confirmPassword"
                                        class="form-control @error('confirmPassword') is-invalid @enderror"
                                        id="exampleFormControlInput1" placeholder="Confirm New Password">
                                    @error('confirmPassword')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-outline-primary">Change</button>
                            </form>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('categories.list') }}" class="btn btn-dark">Go back</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
