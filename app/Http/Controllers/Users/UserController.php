<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use function PHPUnit\Framework\fileExists;


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

    // show your profile
    public function showProfile()
    {
        $user = Auth::user();
        return view('users.profile.showProfile', compact('user'));
    }

    // user profile edit page
    public function editProfile()
    {
        $user = Auth::user();
        return view('users.profile.editProfile', compact('user'));
    }

    // User Profile Update Process
    public function updateProfile(Request $request, $id)
    {
        $this->profileValidation($request);
        $data = $this->profileRequestData($request);

        // Profile Image Upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if (Auth::user()->profile) {
                $imagePath = public_path('profiles/' . Auth::user()->profile);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Upload new image
            $fileName = uniqid() . '_ktk_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('profiles'), $fileName);
            $data['profile'] = $fileName;
        } else {
            $data['profile'] = Auth::user()->profile;
        }

        // Update user data
        User::where('id', $id)->update($data);

        // Success alert
        Alert::success('Profile Updated', 'Profile updated successfully.');
        return redirect()->route('user.profile');
    }

    // User Profile Request Data
    private function profileRequestData(Request $request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    }

    // Check User Profile Validation
    private function profileValidation(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'phone' => 'required|string|min:8|max:15|unique:users,phone,' . Auth::user()->id,
            'image' => 'nullable|mimes:jpeg,jpg,png,svg|max:2048',
        ]);
    }

    // Change Password Page
    public function changePasswordPage()
    {
        return view('users.profile.changePassword');
    }

    // Change Password
    public function changePassword(Request $request)
    {
        $this->passwordValidation($request);
        $currentLoginPassword = Auth::user()->getAuthPassword();
        if (!Hash::check($request->oldPassword, $currentLoginPassword)) {
            return back()->withErrors(['oldPassword' => 'The current Password is incorrect!']);
        }

        User::where('id', Auth::user()->id)->update([
            'password' => Hash::make($request->newPassword)
        ]);

        Alert::success('Password Changed', 'Password changed successfully!');

        return to_route('userHome');
    }

    // Check Password Validation
    public function passwordValidation(Request $request)
    {
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|same:newPassword|min:6',
        ]);
    }
}
