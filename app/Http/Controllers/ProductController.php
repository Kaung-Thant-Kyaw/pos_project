<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use RealRashid\SweetAlert\Facades\Alert;

use function PHPUnit\Framework\fileExists;

class ProductController extends Controller
{
    // Product Create Page
    public function create()
    {
        $categories = Category::get();
        return view('admins.products.create', compact('categories'));
    }

    // Product store
    public function store(Request $request)
    {
        $this->productValidation($request, 'store');
        $data = $this->requestProductData($request);
        if ($request->hasFile('image')) {
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('products'), $fileName);
            $data['image'] = $fileName;
        }


        Product::create($data);
        Alert::success('Product Created', 'Product Created Successfully');
        return back();
    }

    // Product List Page
    public function list($amt = 'default')
    {
        $products = Product::select('products.id', 'products.name', 'products.image', 'products.price', 'products.stock', 'products.category_id', 'products.created_at', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->when(request('searchKey'), function ($query) {
                $query->whereAny(['products.name', 'categories.name'], 'like', '%' . request('searchKey') . '%');
            });
        if ($amt != 'default') {
            $products->where('stock', '<=', 3);
        }

        $products = $products->orderBy('created_at', 'desc')->get();
        return view('admins.products.list', compact('products'));
    }

    // Product Detail Page
    public function show($id)
    {
        $product = Product::select(
            'products.id',
            'products.name',
            'products.image',
            'products.price',
            'products.stock',
            'products.description',
            'products.category_id',
            'products.created_at',
            'products.updated_at',
            'categories.name as category_name'
        )
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.id', $id)
            ->first();
        return view('admins.products.show', compact('product'));
    }

    // Product Delete
    public function destroy($id)
    {
        $product = Product::find($id);

        // Image Delete
        $imagePath = public_path('products/' . $product->image);
        if (fileExists($imagePath)) {
            unlink($imagePath);
        }

        $product->delete();
        Alert::success('Product Deleted', 'Product Deleted successfully');

        return to_route('products.list');
    }

    // Product Edit Page
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::get();
        return view('admins.products.edit', compact('product', 'categories'));
    }

    // Update Product
    public function update($id, Request $request)
    {
        $this->productValidation($request, 'update');
        $data = $this->requestProductData($request);
        if ($request->hasFile('image')) {
            $oldImage = public_path('products/' . $request->oldPhoto);
            if (fileExists($oldImage)) {
                unlink($oldImage);
                $fileName = uniqid() . $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('products'), $fileName);
                $data['image'] = $fileName;
            }
        } else {
            $data['image'] = $request->oldPhoto;
        }

        Product::where('id', $id)->update($data);
        Alert::success('Product Updated', 'Product Created Successfully');
        return to_route('products.list');
    }

    // Request Product Data
    private function requestProductData(Request $request)
    {
        return [
            'name' => $request->name,
            'category_id' => $request->categoryId,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
        ];
    }

    // Product Validation
    private function productValidation(Request $request, $action)
    {
        $rules = [
            'name' => 'required|unique:products,name,' . $request->productId,
            'categoryId' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|numeric|max:999',
            'description' => 'required|max:2000',
        ];

        $rules['image'] = $action == 'create' ? 'required|mimes:jpg,png,jpeg,webp|file' : "mimes:jpg,png,jpeg,webp|file";

        $request->validate($rules);
    }
}
