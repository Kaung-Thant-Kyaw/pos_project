<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

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
}
