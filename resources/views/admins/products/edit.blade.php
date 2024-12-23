@extends('admins.layouts.master')

@section('content')
    <div class="container">
        <div class="row p-3">
            <div class="card col-6 offset-3 rounded p-3 shadow-sm">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="oldPhoto" value="{{ $product->image }}">
                    <input type="hidden" name="productId" value="{{ $product->id }}">
                    <div class="card-body">
                        <div class="mb-3">
                            <img src="{{ asset('products/' . $product->image) }}" class="img-thumbnail w-50 mb-2"
                                id="output">
                            <input type="file" name="image"
                                class="form-control @error('image') is-invalid @enderror mt-1" onchange="loadFile(event)">
                            @error('image')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        value="{{ old('name', $product->name) }}" placeholder="Enter Name...">
                                    @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select name="categoryId" id="category"
                                        class="form-control @error('categoryId') is-invalid @enderror">
                                        <option value="">Choose Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('categoryId', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('categoryId')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="text" name="price"
                                        class="form-control @error('price') is-invalid @enderror" id="price"
                                        value="{{ old('price', $product->price) }}" placeholder="Enter Price...">
                                    @error('price')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="text" name="stock"
                                        class="form-control @error('stock') is-invalid @enderror" id="stock"
                                        value="{{ old('stock', $product->stock) }}" placeholder="Enter stock">
                                    @error('stock')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea cols="30" rows="10" name="description"
                                class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Enter description">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100 rounded shadow-sm">Update Product</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
