@extends('admins.layouts.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category List</h1>
        </div>

        {{-- list --}}
        <div class="">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body shadow-sm">
                            <form action="{{ route('categories.create') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Enter Category Name"
                                        value="{{ old('name') }}"
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
                </div>
                <div class="col">
                    <table class="table">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($categories) != 0)
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->created_at->format('j-F-Y') }}</td>
                                        <td>
                                            <a href="{{ route('categories.edit', $category->id) }}"
                                                class="btn btn-secondary btn-sm">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('categories.destroy', $category->id) }}"
                                                class="btn btn-danger btn-sm">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="4">
                                    <h5 class="text-muted">There is no data...</h5>
                                </td>
                            @endif

                        </tbody>
                    </table>
                    <span class="d-flex justify-content-end">
                        {{ $categories->links() }}
                    </span>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
