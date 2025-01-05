@extends('users.layouts.master')

@section('content')
    <div class="container-fluid" style="margin-top: 150px;">
        <div class="card mb-4 rounded border-0 shadow">
            <div class="card-header bg-primary rounded-top py-3 text-white">
                <h5 class="font-weight-bold m-0 text-center">
                    Account Information
                </h5>
            </div>
            <form>
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <img src="{{ asset(Auth::user()->profile == null ? 'admins/img/undraw_profile.svg' : 'profiles/' . Auth::user()->profile) }}"
                                id="output" class="img-profile img-thumbnail rounded-circle w-75 shadow-sm">
                        </div>

                        <div class="col-md-8">
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Name:</div>
                                <div class="col-md-8">
                                    {{ Auth::user()->name != null ? Auth::user()->name : Auth::user()->nickname }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Email:</div>
                                <div class="col-md-8">{{ Auth::user()->email }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Phone:</div>
                                <div class="col-md-8">{{ Auth::user()->phone }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Address:</div>
                                <div class="col-md-8">{{ Auth::user()->address }}</div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('user.profile.changePasswordPage', Auth::user()->id) }}"
                                    class="btn btn-danger btn-sm rounded-pill me-2 text-white shadow-sm">
                                    <i class="fa-solid fa-lock"></i> Change Password
                                </a>
                                <a href="{{ route('user.profile.edit', Auth::user()->id) }}"
                                    class="btn btn-warning btn-sm rounded-pill text-white shadow-sm">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
