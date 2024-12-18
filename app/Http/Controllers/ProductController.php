<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    // Product Create Page
    public function create()
    {
        $categories = Category::get();
        return view('admins.products.create', compact('categories'));
    }
}
