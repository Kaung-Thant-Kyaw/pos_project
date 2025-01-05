@extends('admins.layouts.master')

@section('content')
    <div class="container-fluid py-4">
        <a href="{{ route('admin.order.list') }}" class="btn btn-outline-primary mb-4">
            <i class="fa-solid fa-arrow-left-long me-2"></i> Go Back
        </a>

        <div class="row">
            {{-- Customer Details --}}
            <div class="card col-md-5 m-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-primary">Customer Details</h5>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-5 fw-bold">Name:</div>
                        <div class="col-7">{{ $orderProducts[0]->user_name ?? $orderProducts[0]->user_nickname }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5 fw-bold">Phone:</div>
                        <div class="col-7">
                            {{ $orderProducts[0]->phone == $payslipData->phone ? $orderProducts[0]->phone : $payslipData->phone }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5 fw-bold">Address:</div>
                        <div class="col-7">{{ $payslipData->address }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5 fw-bold">Order Code:</div>
                        <div class="col-7" id="orderCode">{{ $orderProducts[0]->order_code }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5 fw-bold">Order Date:</div>
                        <div class="col-7">{{ $orderProducts[0]->created_at->format('j-F-Y h:i A') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5 fw-bold">Total Price:</div>
                        <div class="col-7">
                            {{ $payslipData->total_amt }} mmk
                            <br>
                            <small class="text-danger">(Includes Delivery Charges)</small>
                        </div>
                    </div>
                </div>
            </div>

            {{--  Payment Details  --}}
            <div class="card col-md-5 m-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-primary">Payment Details</h5>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-5 fw-bold">Contact Phone:</div>
                        <div class="col-7">{{ $payslipData->phone }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5 fw-bold">Payment Method:</div>
                        <div class="col-7">{{ $payslipData->payment_method }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5 fw-bold">Purchase Date:</div>
                        <div class="col-7">{{ $payslipData->created_at->format('j-F-Y h:i A') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5 fw-bold">Receipt:</div>
                        <div class="col-7">
                            <img src="{{ asset('payslip/' . $payslipData->payslip_image) }}" alt="Receipt Image"
                                style="width: 175px;" class="img-thumbnail">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Order Board --}}
        <div class="card shadow-sm">
            <div class="card-header py-3">
                <div class="d-flex justify-content-center">
                    <h3 class="font-weight-bold text-primary m-0 text-center">Order Board</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table-hover table-bordered table align-middle" id="order-table">
                        <thead class="bg-primary text-center text-white">
                            <tr>
                                <th class="col-2">Image</th>
                                <th>Name</th>
                                <th>Order Count</th>
                                <th>Available Stock</th>
                                <th>Product Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orderProducts as $orderProduct)
                                <tr>
                                    <input type="hidden" value="{{ $orderProduct->product_id }}" class="productId">
                                    <input type="hidden" value="{{ $orderProduct->order_count }}"
                                        class="productOrderCount">
                                    <td class="text-center">
                                        <img src="{{ asset('products/' . $orderProduct->product_image) }}"
                                            alt="Product Image" style="width: 75px;" class="img-thumbnail">
                                    </td>
                                    <td>{{ $orderProduct->product_name }}</td>
                                    <td>{{ $orderProduct->order_count }}
                                        @if ($orderProduct->available_stock < $orderProduct->order_count)
                                            <small class="text-danger">(Out of stock)</small>
                                        @endif
                                    </td>
                                    <td>{{ $orderProduct->available_stock }}</td>
                                    <td>{{ $orderProduct->product_price }}</td>
                                    <td>{{ $orderProduct->product_price * $orderProduct->order_count }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-muted text-center">No products in this order.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <button type="submit" value="reject" id="btn-order-reject"
                        class="btn btn-danger rounded-pill mr-1 shadow-sm">
                        Reject
                    </button>

                    <button type="submit" value="confirm" id="btn-order-confirm"
                        class="btn btn-success rounded-pill shadow-sm" {{ $status == false ? 'disabled' : '' }}>
                        Confirm
                    </button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            // Confrim Order button
            $("#btn-order-confirm").click(function() {
                let orderList = [];
                let orderCode = $("#orderCode").text();

                $("#order-table tbody tr").each(function() {
                    let productId = $(this).find(".productId").val();
                    let productOrderCount = $(this).find(".productOrderCount").val();

                    orderList.push({
                        'product_id': productId,
                        'order_count': productOrderCount,
                        'order_code': orderCode

                    });
                });

                $.ajax({
                    type: 'GET',
                    url: '/admin/order/confirmOrder',
                    data: Object.assign({}, orderList),
                    dataType: 'json',
                    success: function(res) {
                        if (res.status == 'success') {
                            location.href = '/admin/order/list';
                        }
                    }
                });

            });

            // Reject Order button
            $("#btn-order-reject").click(function() {
                let data = {
                    'order_code': $("#orderCode").text()
                };

                $.ajax({
                    type: 'GET',
                    url: '/admin/order/rejectOrder',
                    data: data,
                    dataType: 'json',
                    success: function(res) {
                        res.status == 'success' ? location.href = '/admin/order/list' : '';
                    }
                })
            })
        })
    </script>
@endsection
