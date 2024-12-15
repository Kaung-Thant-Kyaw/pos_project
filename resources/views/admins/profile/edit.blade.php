@extends('admins.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="card col mb-4 shadow">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="font-weight-bold text-primary m-0">
                            Admin Profile <span class="text-danger">({{ auth()->user()->role }} Role)</span>
                        </h6>
                    </div>
                </div>
            </div>
            <form action="{{ route('adminProfile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">

                            <img src="{{ asset(Auth::user()->profile == null ? 'admins/img/undraw_profile.svg' : 'profiles/' . Auth::user()->profile) }}"
                                class="img-profile img-thumbnail" id="output">

                            <input type="file" name="image"
                                class="form-control @error('image') is-invalid @enderror mt-1" onchange="loadFile(event)">
                            @error('image')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', auth()->user()->name != null ? auth()->user()->name : auth()->user()->nickname) }}">
                                        @error('name')
                                            <small class="invalid-feedback">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                                        <input type="email" name="email"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('email', auth()->user()->email) }}">
                                        @error('name')
                                            <small class="invalid-feedback">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Phone</label>
                                        <input type="text" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            placeholder="09xxxxxxxxx" value="{{ old('phone', auth()->user()->phone) }}">
                                        @error('phone')
                                            <small class="invalid-feedback">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Address</label>
                                        <input type="text" name="address"
                                            class="form-control @error('address') is-invalid @enderror"
                                            value="{{ old('address', auth()->user()->address) }}"
                                            placeholder="Enter Your Address..">
                                        @error('address')
                                            <small class="invalid-feedback">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Update">

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
