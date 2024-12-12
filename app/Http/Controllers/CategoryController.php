<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{

    // Category list page
    public function list()
    {
        $categories = Category::latest()->paginate(5);
        return view('admins.categories.list', compact('categories'));
    }

    // Create Category
    public function create(Request $request)
    {
        $this->checkValidation($request);
        Category::create($request->all());

        Alert::success('Category Created', 'Category created successfully!');
        return back();
    }

    // Update Page
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admins.categories.edit', compact('category'));
    }

    // Update Category
    public function update($id, Request $request)
    {
        $category = Category::find($id);
        $this->checkValidation($request);
        $category->update(
            [
                'name' => $request->name,
                'updated_at' => Carbon::now()
            ]
        );

        Alert::success('Category Updated', 'Category Updated successfully!');


        return to_route('categories.list');
    }

    public function destroy($id)
    {
        Category::where('id', $id)->delete();

        Alert::success('Category Deleted', 'Category Deleted successfully!');

        return back();
    }

    // Validate Category
    private function checkValidation(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'အမျိုးအစားအမည်ထည့်ရန် လိုအပ်ပါသည်။'
        ]);
    }
}
