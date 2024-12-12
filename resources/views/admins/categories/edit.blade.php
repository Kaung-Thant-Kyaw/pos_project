@extends('admins.layouts.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-center text-gray-800">Update Category</h1>
        </div>

        {{-- list --}}
        <div class="">
            <div class="row">
                <div class="col-4 offset-4">
                    <div class="card">
                        <div class="card-body shadow-sm">
                            <form action="{{ route('categories.update', $category->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Enter Category Name"
                                        value="{{ old('name', $category->name) }}"
                                        class="form-control @error('name')
                                            is-invalid
                                        @enderror">
                                    @error('name')
                                        <small class="invalid-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-outline-primary">Create</button>
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
