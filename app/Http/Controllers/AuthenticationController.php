<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthenticationService;

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
}
