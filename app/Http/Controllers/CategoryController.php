<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{

    // Category list page
    public function list()
    {
        return view('admins.categories.list');
    }
}
