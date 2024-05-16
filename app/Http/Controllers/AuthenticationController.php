<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\LinkaUsers;
use App\Models\User;
use App\Services\AuthenticationService;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class AuthenticationController extends Controller
{
    public function __construct(protected AuthenticationService $service)
    {
    }


    public function registerUser(RegisterRequest $request)
    {
        try {
            $this->service->registerUser($request->name, $request->email, $request->password);

            return response()->json(["User Account Created Successfully"]);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

   
    public function loginUser(LoginRequest $request)
    {
        try {
            $result = $this->service->loginUser($request->email, $request->password);

            return response()->json($result);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver("google")->user();

        // Check if the user already exists in the database
        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {

            $linkaUserID = $this->validateLinkaUser($existingUser->id);

            $token = $user->token;

            $response = [
                "userID" => $linkaUserID,
                "name" => $user->name,
                "googleProfile" => $user->avatar,
                "token" => $token,
                "message" => "Login Successfully",
            ];
        } else {
            // Create a new user with the received data
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                // Add other relevant fields
            ]);

            LinkaUsers::create([
                "user_id" => $newUser->id,
                "user_type_id" => 1, //  this is user type of member user
                "provider" => "google",
                "provider_id" => $user->id,
            ]);

            $linkaUserID = $this->validateLinkaUser($newUser->id);

            $token = $user->token;

            $response = [
                "userID" => $linkaUserID,
                "name" => $user->name,
                "googleProfile" => $user->avatar,
                "token" => $token,
                "message" => "Login Successfully",
            ];
        }

        return response()->json($response);
    }

    public function validateLinkaUser(int $userID)
    {
        $linkaUserID = DB::selectOne("SELECT LinkaUsers.id FROM LinkaUsers
                                      INNER JOIN users
                                      ON LinkaUsers.user_id = users.id
                                      WHERE users.id = ?", [$userID]);

        return $linkaUserID->id;

    }
}
