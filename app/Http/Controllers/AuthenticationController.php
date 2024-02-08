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

    /**
     * @OA\Post(
     *     path="/api/register",
     *     operationId="register",
     *     tags={"Authentication"},
     *     summary="Register a new user",
     *     description="Registers a new user and returns an authentication token and user profile",
     *     @OA\RequestBody(
     *         required=true,
     *         description="User details",
     *         @OA\JsonContent(
     *             required={"name", "email", "password"},
     *             @OA\Property(property="name", type="text", example="Ganza Heritier"),
     *             @OA\Property(property="email", type="text", format="email", example="linka@gmail.com"),
     *             @OA\Property(property="password", type="password", format="password", example="password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User registered successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="access_token", type="string"),
     *             @OA\Property(property="token_type", type="string", example="Bearer"),
     *             @OA\Property(property="expires_at", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="string", example="Validation failed")
     *         )
     *     )
     * )
     */
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

    /**
     * @OA\Post(
     *     path="/api/login",
     *     operationId="login",
     *     tags={"Authentication"},
     *     summary="Login User",
     *     description="Returns an authentication token user profile if user are valid",
     *     @OA\RequestBody(
     *         required=true,
     *         description="User credentials",
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="ganzatambaheritier24@gmail.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="user", type="Object"),
     *             @OA\Property(property="token", type="string", example="RM_EgTIxvheXzrdRdP05aKluwyGLCow1myMxNGEOnk74HPi0IKOtzhkeZVxHwvkmMe4J2zhUBD1CUniDd32dhaU5znwMMs6QuEUCl_cBYlY_E2VvYVB2RC0suOTrE0xdlArUpaCgYKAa0SARASFQHGX2MiEPL8fscfIhBbUAWJ9sJY"),
     *             @OA\Property(property="message", type="string", example="Login Successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="string", example="Unauthorized")
     *         )
     *     )
     * )
     */
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
