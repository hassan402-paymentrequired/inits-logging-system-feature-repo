<?php

namespace App\Http\Controllers\Web\Oauth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OauthController extends Controller
{
    public function redirectToGoogleAuth()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback()
    {
        $user_google_cred = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $user_google_cred->email)->first();

        if (!$user) {
            return redirect()->back()->with('no_user_found', "The credentials does'nt not match our record");
        }

        Auth::login($user);
        return redirect(route('dashboard')); 
    }
}
