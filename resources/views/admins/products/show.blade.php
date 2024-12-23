@extends('admins.layouts.master')

@section('content')
    <div class="container">
        <div class="row p-3">
            <div class="col">
                <a href="{{ route('products.list') }}" class="btn btn-outline-secondary btn-sm rounded">
                    <i class="fa-solid fa-arrow-left"></i> Back to Products
                </a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Product Image</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ asset('products/' . $product->image) }}" alt="{{ $product->name }}"
                            class="img-fluid img-thumbnail rounded shadow-sm" style="max-height: 400px;">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Product Details</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>ID:</strong> {{ $product->id }}</p>
                        <p><strong>Name:</strong> {{ $product->name }}</p>
                        <p><strong>Price:</strong> {{ $product->price }}mmk</p>
                        <p><strong>Stock:</strong>
                            <button type="button" class="btn btn-secondary position-relative">
                                {{ $product->stock }}
                                @if ($product->stock <= 3)
                                    <span
                                        class="position-absolute start-100 translate-middle badge rounded-pill bg-danger top-0">
                                        Less Stock
                                    </span>
                                @endif
                            </button>
                        </p>
                        <p><strong>Category:</strong> {{ $product->category_name }}</p>
                        <p><strong>Description:</strong> {{ $product->description }}</p>

                        <div class="mt-4">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-warning btn-sm">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                            <a href="{{ route('products.destroy', $product->id) }}" class="btn btn-outline-danger btn-sm">
                                <i class="fa-solid fa-trash"></i> Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <p><strong>Created At:</strong> {{ $product->created_at->format('j-F-Y') }}</p>
            </div>
        </div>
    </div>
@endsection
