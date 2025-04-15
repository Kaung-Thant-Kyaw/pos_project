@extends('users.layouts.master')

@section('content')
    <div class="container" style="margin-top: 150px;">
        <div class="row">
            <table class="table-hover table shadow-sm">
                <thead>
                    <tr>
                        <th>Date </th>
                        <th>Order Code </th>
                        <th>Order Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->created_at->format('j-F-Y') }}</td>
                            <td>{{ $order->order_code }}</td>
                            <td>
                                @if ($order->status == 0)
                                    <span class="btn btn-warning btn-sm shadow-sm">Pending</span>
                                @elseif ($order->status == 1)
                                    <span class="btn btn-success btn-sm shadow-sm">Success</span>
                                    <span class="text-danger">
                                        <i class="fa-solid fa-clock-rotate-left"></i>
                                        Waiting time: 3 days!
                                    </span>
                                @else
                                    <span class="btn btn-danger btn-sm shadow-sm">Reject</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
@endsection
