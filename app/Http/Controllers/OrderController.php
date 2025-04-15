<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;

class OrderController extends Controller
{

    // Order List
    public function list()
    {
        $orders = Order::select(
            'orders.id',
            'orders.status',
            'orders.order_code',
            'orders.created_at',
            'users.name as user_name'
        )
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->when(request('searchKey'), function ($query) {
                $query->whereAny(['orders.order_code', 'users.name'], 'like', '%' . request('searchKey') . '%');
            })
            ->when(!is_null(request('status')), function ($query) {
                $query->where('orders.status', request('status'));
            })
            ->orderBy('created_at', 'desc')
            ->groupBy('order_code')
            ->paginate(10);

        return view('admins.orders.list', compact('orders'));
    }

    // Order detail
    public function detail($orderCode)
    {
        $orderProducts = Order::select(
            'orders.count as order_count',
            'orders.order_code',
            'orders.created_at',
            'products.id as product_id',
            'products.name as product_name',
            'products.price as product_price',
            'products.image as product_image',
            'products.stock as available_stock',
            'users.name as user_name',
            'users.nickname as user_nickname',
            'users.phone',
            'users.email',
            'users.address'
        )
            ->leftJoin('products', 'orders.product_id', 'products.id')
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->where('order_code', $orderCode)
            ->get();

        $status = true;
        $confirmStatus = [];
        foreach ($orderProducts as $orderProduct) {
            array_push(
                $confirmStatus,
                $orderProduct->available_stock < $orderProduct->order_count ? false : true
            );
        }
        foreach ($confirmStatus as $item) {
            if ($item == false) {
                $status = false;
                break;
            }
        }


        $payslipData = PaymentHistory::where('order_code', $orderCode)->first();
        return view('admins.orders.detail', compact('orderProducts', 'payslipData', 'status'));
    }

    // Order change status
    public function changeStatus(Request $request)
    {
        Order::where('order_code', $request['order_code'])->update([
            'status' => $request['status']
        ]);

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    // Confirm customer's order
    public function confirmOrder(Request $request)
    {
        Order::where('order_code', $request[0]['order_code'])
            ->update([
                'status' => 1
            ]);

        foreach ($request->all() as $item) {
            Product::where('id', $item['product_id'])->decrement('stock', $item['order_count']);
        }
        return response()->json([
            'status' => 'success'
        ], 200);
    }

    // Reject customer's order
    public function rejectOrder(Request $request)
    {
        Order::where('order_code', $request['order_code'])
            ->update([
                'status' => 2
            ]);

        return response()->json([
            'status' => 'success'
        ], 200);
    }
}
