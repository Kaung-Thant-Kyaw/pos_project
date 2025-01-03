@extends('users.layouts.master')

@section('content')
    <div class="container-fluid" style="margin-top: 150px;">
        <div class="card col mb-4 rounded border-0 shadow-lg">
            <div class="card-header bg-primary rounded-top py-3 text-white">
                <h6 class="font-weight-bold m-0 text-center">
                    Update User Profile
                </h6>
            </div>
            <form action="{{ route('user.profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data"
                class="p-4">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <!-- Profile Image Section -->
                        <div class="col-md-3 text-center">
                            <div class="mb-3">
                                <img src="{{ asset(Auth::user()->profile == null ? 'admins/img/undraw_profile.svg' : 'profiles/' . Auth::user()->profile) }}"
                                    class="img-thumbnail rounded-circle shadow-sm" style="width: 150px; height: 150px;"
                                    id="output">
                            </div>
                            <label for="image" class="form-label fw-bold">Profile Picture</label>
                            <input type="file" name="image"
                                class="form-control @error('image') is-invalid @enderror mt-2" onchange="loadFile(event)">
                            @error('image')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <!-- User Details Section -->
                        <div class="col-md-9">
                            <div class="row">
                                <!-- Name Field -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label fw-bold">Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', auth()->user()->name ?? auth()->user()->nickname) }}">
                                    @error('name')
                                        <small class="invalid-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>

                                <!-- Email Field -->
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', auth()->user()->email) }}">
                                    @error('email')
                                        <small class="invalid-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>

                                <!-- Phone Field -->
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label fw-bold">Phone</label>
                                    <input type="text" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror" placeholder="09xxxxxxxxx"
                                        value="{{ old('phone', auth()->user()->phone) }}">
                                    @error('phone')
                                        <small class="invalid-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>

                                <!-- Address Field -->
                                <div class="col-md-6 mb-3">
                                    <label for="address" class="form-label fw-bold">Address</label>
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

                                <!-- Submit Button -->
                                <div class="col-12 text-end">
                                    <input type="submit" class="btn btn-primary px-4 py-2 shadow-sm" value="Update">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function loadFile(event) {
            var reader = new FileReader();

            reader.onload = function() {
                var output = document.getElementById('output');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
