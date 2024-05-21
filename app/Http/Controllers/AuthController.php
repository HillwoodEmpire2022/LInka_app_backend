<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Login;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    //

    public function Register(RegisterRequest $request){

        $data = $request->validated();
        $user=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password'=>bcrypt($data['password'])
        ]);
        
        $token = $user->createToken('userToken')->plainTextToken;

        $response = [
            'user'=>$user,
            'token'=>$token
        ];
        return response($response,201);
    }

    public function Login(LoginRequest $request){
        $data = $request->validated();
        //  check for Email
        if (!Auth::attempt($data)) {
            return response([
                'message' => 'Provided email or password is incorrect'
            ], 422);
        }
         /** @var \App\Models\User $user */
        $user = Auth::user();
        $token = $user->createToken('userToken')->plainTextToken;
        return response(compact('user', 'token'));
    }

    public function logout(Request $request){

      /** @var \App\Models\User $user */
         $user = $request->user();
        //  $user->currentAccessToken()->delete();
        return [
            'message'=>'logged out'
        ];
    }

    public function forgot(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? response()->json(['message' => __($status)])
                    : response()->json(['message' => __($status)], 400);
    }

    public function ResetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);
        $response = Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );
        if ($response == Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Password reset successfully']);
        } else {
            return response()->json(['message' => 'Unable to reset password'], 400);
        }
    }
    
}
