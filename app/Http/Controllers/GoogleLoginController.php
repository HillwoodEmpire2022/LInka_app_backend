<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
class GoogleLoginController extends Controller
{
    //
    public function redirectToGoogle(): RedirectResponse
    {
       return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
{
    $user =  Socialite::driver('google')->user();
    $existingUser = User::where('email', $user->email)->first();

    if($existingUser){
        // Update existing user's Google ID
        $existingUser->google_id = $user->id;
        $existingUser->save();
        auth()->login($existingUser, true);
    }else{
        // Create a new user.
        $newUser = new User();
        $newUser->name = $user->name;
        $newUser->email = $user->email;
        $newUser->google_id = $user->id;
        $newUser->password = bcrypt(request(Str::random())); // Set some random password
        $newUser->save();
        // Log in the new user.
        auth()->login($newUser, true);
    }
    // Redirect to the URL as requested by the user, if empty use /dashboard page as generated by Jetstream
    return response()->json(([
        'message'=>'Logged in with google sucessfully'
    ]));
}
}
