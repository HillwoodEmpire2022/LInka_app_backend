<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Packages\Application\SignUp\RegisterRequest;
use App\Packages\Application\SignUp\RegisterService;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    //
    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Register a new user",
     * tags={"Auth"},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="User's name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="User's email",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="User's password",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="201", description="User registered successfully"),
     *     @OA\Response(response="422", description="Validation errors"),
     *  @OA\Response(response="419", description="Page expired")
     * )
     */

    
    public function register(Request $request, RegisterService $registerService){
        $signup = new RegisterRequest($request);
        return $registerService->create($signup);
    }
    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Authenticate user and generate JWT token",
     *     tags={"Auth"},
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="User's email",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="User's password",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *   
     *     @OA\Response(response="200", description="Login successful"),
     *     @OA\Response(response="401", description="Invalid credentials"),
     *     @OA\Response(response="419", description="Page expired")
     * )
     */

    public function Login(LoginRequest $request)
    {
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

    public function logout(Request $request)
    {

        /** @var \App\Models\User $user */
        $user = $request->user();
        //  $user->currentAccessToken()->delete();
        return [
            'message' => 'logged out'
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
