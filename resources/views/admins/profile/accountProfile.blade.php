@extends('admins.layouts.master')

@section('content')
    <div class="container-fluid">
        {{-- Profile Card --}}
        <div class="card col mb-4 shadow">
            {{-- Header --}}
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="font-weight-bold text-primary m-3">
                            Account Information
                        </h6>
                    </div>
                </div>
            </div>
            {{-- Body --}}
            <form>
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-2 offset-1">
                            <img src="{{ asset(Auth::user()->profile == null ? 'admins/img/undraw_profile.svg' : 'profiles/' . Auth::user()->profile) }}"
                                id="output" class="img-profile img-thumbnail">
                        </div>
                        <div class="col offset-1">
                            <div class="row mt-3">
                                <div class="col-2 h-5">
                                    Name:
                                </div>
                                <div class="col h-5">
                                    {{ Auth::user()->name ?? Auth::user()->nickname }}
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-2 h-5">
                                    Email:
                                </div>
                                <div class="col h-5">
                                    {{ Auth::user()->email }}
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-2 h-5">
                                    Phone:
                                </div>
                                <div class="col h-5">
                                    {{ Auth::user()->phone }}
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-2 h-5">
                                    Address:
                                </div>
                                <div class="col h-5">
                                    {{ Auth::user()->address }}
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-2 h-5">
                                    Role:
                                </div>
                                <div class="col text-danger h-5">
                                    {{ Auth::user()->role }}
                                </div>
                            </div>
                            <a href="{{ route('profile.changePassword.page') }}"
                                class="btn btn-danger btn-sm rounded text-white shadow-sm">
                                <i class="fa-solid fa-lock"></i>
                                Change your password
                            </a>
                            <a href="{{ route('profile.changePassword.page') }}"
                                class="btn btn-warning btn-sm rounded text-white shadow-sm">
                                <i class="fa-solid fa-pen-to-square"></i>
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
