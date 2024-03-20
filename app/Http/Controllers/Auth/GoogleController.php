<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return \Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        // You can now use the $user data to create or authenticate the user in your system
        // For example, you might want to check if the user exists and log them in.

        return redirect('/dashboard'); // Redirect to home or any other route after authentication
    }
}
