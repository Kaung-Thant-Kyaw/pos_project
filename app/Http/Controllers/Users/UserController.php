<?php

namespace App\Http\Controllers\Users;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function home()
    {
        $categories = Category::get();
        $products = Product::select(
            'products.id',
            'products.image',
            'products.name',
            'products.price',
            'products.description',
            'products.created_at',
            'categories.name as category_name'
        )
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            // Search Product
            ->when(request('searchKey'), function ($query) {
                $query->where('products.name', 'like', '%' . request('searchKey') . '%');
            })
            // Sort
            ->when(request('sortingType'), function ($query) {
                $sortType = explode(',', request('sortingType'));
                $sortName = 'products.' . $sortType[0];
                $sortBy =  $sortType[1];
                $query->orderBy($sortName, $sortBy);
            })
            // Filter By Category
            ->when(request('categoryId') != null, function ($query) {
                $query->where('products.category_id', request('categoryId'));
            })
            // Filter By Price
            ->when(request('minPrice') || request('maxPrice'), function ($query) {
                $minPrice = request('minPrice');
                $maxPrice = request('maxPrice');
                if ($minPrice && $maxPrice) {
                    $query->whereBetween('products.price', [$minPrice, $maxPrice]);
                } elseif ($minPrice) {
                    $query->where('products.price', '>=', $minPrice);
                } elseif ($maxPrice) {
                    $query->where('products.price', '<=', $maxPrice);
                }
            })
            //->orderBy('products.created_at', 'desc')
            ->get();
        return view('users.home.list', compact('products', 'categories'));
    }
}
