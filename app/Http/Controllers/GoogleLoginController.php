<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;


class GoogleLoginController extends Controller
{
    
    public function redirectToGoogle()
    {
        return response()->json(['url' => Socialite::driver('google')
            
            ->redirect()->getTargetUrl()]);
    }

    public function handleGoogleCallback(){
        try{
            $googleUser = Socialite::driver('google')->user();
            Log::info('Google User Info: ' . json_encode($googleUser)); 
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user){
                Auth::login($user);
            }else{
                $user = User::create([
                    'name'=>$googleUser->getName(),
                    'email'=>$googleUser->getEmail(),
                    'google_id'=>$googleUser->getId(),
                    'password'=>bcrypt(Str::random(16)),
                    // 'role'=>'user',
                ]);
                Auth::login($user);
            }

            $token = $user->createToken('authToken')->accessToken;
            $redirectUrl = $user->isAdmin() ? '/dashboard' : '/dashboard';

            return response()->json(['token'=>$token, 'redirect_url'=>$redirectUrl]);
        }catch (\Exception $e){
            Log::error('Google Login Error: ' . $e->getMessage());
            return response()->json(['error'=>'Failed to login with google.'], 500);
        }
    }

}
