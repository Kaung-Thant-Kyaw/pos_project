@extends('admins.layouts.master')

@section('content')
    <div class="container">
        <div class="row p-3">
            <div class="col">
                <button class="btn btn-outline-secondary btn-sm rounded">
                    <i class="fa-solid fa-database"></i> Product count
                    ({{ count($products) }})
                </button>
                <a href="{{ route('products.list') }}" class="btn btn-outline-primary btn-sm rounded">All Products</a>
                <a href="{{ route('products.list', 'lowAmount') }}"
                    class="btn btn-outline-danger btn-sm rounded shadow-sm">Less Stock
                    Product list</a>

            </div>
            <div class="col-6 offset-1">
                <!-- Search Form -->
                <form action="{{ route('products.list') }}" method="GET" class="d-flex justify-content-center mb-4">
                    <input type="text" name="searchKey" class="form-control w-75 me-2" placeholder="Search"
                        value="{{ request('searchKey') }}">
                    <a href="{{ route('products.list') }}" class="btn btn-secondary mx-2">
                        <i class="fa-solid fa-times-circle"></i>
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table shadow-sm">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    <img src="{{ asset('products/' . $product->image) }}" alt="Product Image"
                                        class="img-thumbnail rounded shadow-sm" style="width: 100px;">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}mmk</td>
                                <td class="col-2">
                                    <button type="button" class="btn btn-secondary position-relative">
                                        {{ $product->stock }}
                                        @if ($product->stock <= 3)
                                            <span
                                                class="position-absolute start-100 translate-middle badge rounded-pill bg-danger top-0">
                                                Less Stock
                                            </span>
                                        @endif

                                    </button>

                                </td>
                                <td>{{ $product->category_name }}</td>

                                <td>
                                    <a href="{{ route('products.show', $product->id) }}"
                                        class="btn btn-outline-success btn-sm">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('products.edit', $product->id) }}"
                                        class="btn btn-outline-warning btn-sm">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="{{ route('products.destroy', $product->id) }}"
                                        class="btn btn-outline-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="h5 text-muted text-center">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                {{-- <div class="d-flex justify-content-end">
                    {{ $products->links() }}
                </div> --}}
            </div>
        </div>
    </div>
@endsection
