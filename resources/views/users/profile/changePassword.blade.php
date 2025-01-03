@extends('users.layouts.master')

@section('content')
    <div class="container-fluid" style="margin-top: 150px;">

        <!-- Heading Section -->
        <div class="mb-4 text-center">
            <h1 class="h3 text-gray-800">Change Password</h1>
            <p class="text-muted">Ensure your account is secure by using a strong and unique password.</p>
        </div>

        <!-- Form Section -->
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <!-- Feedback Messages -->
                        @if (session('success'))
                            <div class="alert alert-success text-center">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger text-center">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('user.profile.changePassword') }}" method="POST">
                            @csrf

                            <!-- Old Password -->
                            <div class="mb-4">
                                <label for="oldPassword" class="form-label fw-bold">Old Password</label>
                                <input type="password" name="oldPassword" id="oldPassword"
                                    class="form-control @error('oldPassword') is-invalid @enderror"
                                    placeholder="Enter your current password">
                                @error('oldPassword')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="newPassword" class="form-label fw-bold">New Password</label>
                                <div class="input-group">
                                    <input type="password" name="newPassword" id="newPassword"
                                        class="form-control @error('newPassword') is-invalid @enderror"
                                        placeholder="Enter a new strong password">
                                </div>
                                @error('newPassword')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="confirmPassword" class="form-label fw-bold">Confirm New Password</label>
                                <input type="password" name="confirmPassword" id="confirmPassword"
                                    class="form-control @error('confirmPassword') is-invalid @enderror"
                                    placeholder="Re-enter the new password">
                                @error('confirmPassword')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100">
                                    Change Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
