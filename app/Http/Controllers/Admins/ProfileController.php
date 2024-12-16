<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

use function PHPUnit\Framework\fileExists;

class ProfileController extends Controller
{

    // direct to change password page
    public function changePasswordPage()
    {
        return view('Admins.profile.changePassword');
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

        return to_route('adminHome');
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

    // Show Profile
    public function show()
    {
        return view('admins.profile.accountProfile');
    }

    // Profile Edit Page
    public function edit()
    {
        return view('admins.profile.edit');
    }

    // Profile Update
    public function update(Request $request)
    {
        $this->profileValidation($request);
        $data = $this->profileRequestData($request);

        if ($request->hasFile('image')) {

            // Delete old image
            if (Auth::user()->profile != null) {
                $imagePath = public_path('/profiles/' . Auth::user()->profile);
                if (fileExists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $fileName = uniqid() . '_ktk_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path() . '/profiles/', $fileName);
            $data['profile'] = $fileName;
        } else {
            $data['profile'] = Auth::user()->profile;
        }

        User::where('id', Auth::user()->id)->update($data);
        Alert::success('Profile Updated', 'Profile Updated Successfully');
        return to_route('adminProfile.show');
    }

    // Profile Request data
    private function profileRequestData(Request $request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    }


    // Check Profile Validation
    private function profileValidation(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . Auth::user()->id,
            'phone' => 'required|min:8|max:15|unique:users,phone,' . Auth::user()->id,
            'image' => 'mimes:jpeg,jpg,png,svg|file'
        ]);
    }

    /**
     * Add New Admin Account
     */

    //  Add Admin Form Page
    public function create()
    {
        return view('admins.adminAccount.create');
    }

    // Admin Account Creation
    public function store(Request $request)
    {
        $this->addAdminAccValidation($request);
        $data = $this->adminAccRequestData($request);
        User::create($data);
        Alert::success('Admin account create', 'Admin account created successfully!');
        return to_route('adminProfile.show');
    }

    // Admin Account Request Data
    private function adminAccRequestData(Request $request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ];
    }

    // Add-admin acc validation
    private function addAdminAccValidation(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:20',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|max:15',
            'confirmPassword' => 'required|same:password|min:6|max:15',
        ]);
    }
}
