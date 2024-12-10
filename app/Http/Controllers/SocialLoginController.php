<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialLoginController extends Controller
{
    //provider => Google || Github
    // redirect | Send to provider server
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // callback | Receive from provider server
    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $user = User::updateOrCreate([
            'provider_id' => $socialUser->id,
        ], [
            'provider' => $provider,
            'name' => $socialUser->name,
            'nickname' => $socialUser->nickname,
            'email' => $socialUser->email,
            'provider_token' => $socialUser->token,
            'role' => 'user'
        ]);

        Auth::login($user);

        return to_route('userHome');
    }
}
