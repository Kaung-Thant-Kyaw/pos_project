<?php

namespace App\Http\Controllers\Users;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

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
            'carts.id',
            'carts.qty',
            'products.id',
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
}
