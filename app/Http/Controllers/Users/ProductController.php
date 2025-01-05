<?php

namespace App\Http\Controllers\Users;

use App\Models\Cart;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymentHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    // Product Detail for Customer Side
    public function show($id)
    {
        $product = Product::select(
            'products.id',
            'products.image',
            'products.name',
            'products.price',
            'products.stock as available_stock',
            'products.description',
            'products.created_at',
            'categories.name as category_name'
        )
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('products.id', $id)
            ->first();
        $relatedProducts = Product::select(
            'products.id',
            'products.image',
            'products.name',
            'products.price',
            'products.description',
            'products.created_at',
            'categories.name as category_name'
        )
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('products.id', '!=', $id)
            ->where('categories.name', $product->category_name)->get();
        return view('users.home.show', compact('product', 'relatedProducts'));
    }

    // Add To Cart
    public function addToCart(Request $request)
    {
        Cart::create(
            [
                'user_id' => $request->userId,
                'product_id' => $request->productId,
                'qty' => $request->count
            ]
        );

        return to_route('userHome');
    }

    // Direct to Cart Page
    public function cart()
    {
        $cart = Cart::select(
            'carts.id as cart_id',
            'carts.qty',
            'products.id as product_id',
            'products.name',
            'products.image',
            'products.price',
        )
            ->leftJoin('products', 'carts.product_id', 'products.id')
            ->where('carts.user_id', Auth::user()->id)
            ->get();
        $total = 0;
        foreach ($cart as $item) {
            $total += ($item->price * $item->qty);
        }
        return view('users.home.cart', compact('cart', 'total'));
    }

    // Cart Delete
    public function cartDelete(Request $request)
    {
        $cartId = $request->cartId;
        Cart::where('id', $cartId)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Cart Deleted Successfully!'
        ], 200);
    }

    // cart list api
    public function cartList()
    {
        $products = Product::latest()->get();

        return response()->json([
            'products' => $products
        ], 200);
    }

    // Cart Temp
    public function cartTemp(Request $request)
    {
        $orderArr = [];
        foreach ($request->all() as $item) {
            array_push($orderArr, [
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'count' => $item['qty'],
                'status' => 0,
                'order_code' => $item['order_code'],
                'total_amt' => $item['total_amt']
            ]);
        }

        Session::put('temp_cart', $orderArr);

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    // Payment
    public function payment()
    {
        $payments = Payment::orderBy('type', 'asc')->get();
        $orderProducts = Session::get('temp_cart');
        return view('users.home.payment', compact('payments', 'orderProducts'));
    }

    // Order
    public function order(Request $request)
    {
        // Order Validation
        $request->validate([
            'phone' => 'required|digits_between:7,15',
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string',
            'payslip_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Store in payment history table
        $paymentHistoryData = [
            'user_name' => $request->user_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'order_code' => $request->order_code,
            'total_amt' => $request->total_amt,
        ];

        if ($request->hasFile('payslip_image')) {
            $fileName = uniqid() . $request->file('payslip_image')->getClientOriginalName();
            $request->file('payslip_image')->move(public_path() . '/payslip/', $fileName);

            $paymentHistoryData['payslip_image'] = $fileName;
        }

        PaymentHistory::create($paymentHistoryData);

        // Order and clear temp cart
        $orderProducts = Session::get('temp_cart');
        foreach ($orderProducts as $orderProduct) {
            Order::create([
                'user_id' => $orderProduct['user_id'],
                'product_id' => $orderProduct['product_id'],
                'count' => $orderProduct['count'],
                'status' => $orderProduct['status'],
                'order_code' => $orderProduct['order_code']
            ]);
        }

        // temp cart delete
        Cart::where('user_id', $orderProduct['user_id'])
            ->where('product_id', $orderProduct['product_id'])
            ->delete();

        return to_route('userHome');
    }

    // User Order list
    public function orderList()
    {
        $orders =  Order::where('user_id', Auth::user()->id)
            ->groupBy('order_code')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('users.home.orderList', compact('orders'));
    }
}
