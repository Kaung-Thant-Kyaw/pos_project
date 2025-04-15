@extends('admins.layouts.master')

@section('content')
    <div class="container">
        <div class="row p-3">
            <div class="col-4">
                <a href="{{ route('adminHome') }}" class="btn btn-outline-primary">
                    <i class="fa-solid fa-arrow-left"></i>
                    Go back
                </a>
            </div>
            <div class="col-8">
                <form action="{{ route('admin.order.list') }}" method="GET" class="d-flex justify-content-center mb-4">
                    <input type="text" name="searchKey" class="form-control w-50 me-2" placeholder="Search"
                        value="{{ request('searchKey') }}">
                    <a href="{{ route('admin.order.list') }}" class="btn btn-secondary mx-2">
                        <i class="fa-solid fa-times-circle"></i>
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
        </div>

        {{-- Filter by Order Status --}}
        <div class="row mb-3">
            <div class="col text-center">
                <a href="{{ route('admin.order.list') }}"
                    class="btn {{ is_null(request('status')) ? 'btn-primary' : 'btn-outline-primary' }}">
                    All Orders
                </a>
                <a href="{{ route('admin.order.list', ['status' => 0]) }}"
                    class="btn {{ request('status') == '0' ? 'btn-warning' : 'btn-outline-warning' }}">
                    Pending Orders
                </a>
                <a href="{{ route('admin.order.list', ['status' => 1]) }}"
                    class="btn {{ request('status') == '1' ? 'btn-success' : 'btn-outline-success' }}">
                    Accepted Orders
                </a>
                <a href="{{ route('admin.order.list', ['status' => 2]) }}"
                    class="btn {{ request('status') == '2' ? 'btn-danger' : 'btn-outline-danger' }}">
                    Rejected Orders
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <table class="table-hover table align-middle">
                    <thead class="bg-primary text-center text-white">
                        <tr>
                            <th>Date</th>
                            <th>Order Code</th>
                            <th>User Name</th>
                            <th>Action</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <input type="hidden" value="{{ $order->order_code }}" class="order-code">
                                <td>{{ $order->created_at->format('j-F-Y h:i A') }}</td>
                                <td>
                                    <a href="{{ route('admin.order.detail', $order->order_code) }}">
                                        {{ $order->order_code }}
                                    </a>
                                </td>
                                <td>{{ $order->user_name }}</td>
                                <td>
                                    <select class="form-select-sm status-change form-select">
                                        <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Pending</option>
                                        <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Accept</option>
                                        <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Reject</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    @if ($order->status == 0)
                                        <i class="fa-solid fa-hourglass-start text-warning"></i>
                                    @elseif ($order->status == 1)
                                        <i class="fa-solid fa-circle-check text-success"></i>
                                    @elseif ($order->status == 2)
                                        <i class="fa-regular fa-circle-xmark text-danger"></i>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-muted text-center">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-end">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.status-change').change(function() {
                let changeStatus = $(this).val();
                let orderCode = $(this).closest("tr").find(".order-code").val();

                $data = {
                    'order_code': orderCode,
                    'status': changeStatus
                };

                $.ajax({
                    type: 'get',
                    url: '/admin/order/changeStatus',
                    data: $data,
                    dataType: 'json',
                    success: function(res) {
                        res.status == 'success' ? location.reload() : '';
                    }
                })
            })

        })
    </script>
@endsection
