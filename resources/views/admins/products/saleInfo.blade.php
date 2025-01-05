@extends('admins.layouts.master')

@section('content')
    <div class="container">
        <h1 class="bg-primary mb-4 py-3 text-center text-white">Sale Information</h1>

        <table class="table-bordered table">
            <thead>
                <tr>
                    <th>Order Code</th>
                    <th>Product</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Product Price</th>
                    <th>Customer Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Payment Method</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sales as $sale)
                    <tr>
                        <td>{{ $sale->order_code }}</td>
                        <td>
                            <img src="{{ asset('products/' . $sale->product_image) }}" class="img-thumbnail"
                                alt="Product Image">
                        </td>
                        <td>{{ $sale->product_name }}</td>
                        <td>{{ $sale->count }}</td>
                        <td>{{ $sale->product_price }}</td>
                        <td>{{ $sale->user_name }}</td>
                        <td>{{ $sale->phone }}</td>
                        <td>{{ $sale->address }}</td>
                        <td>{{ $sale->payment_method }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No Sale Information Available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
