<?php

namespace App\Http\Controllers;
use App\Services\MachingService;

class MachingController extends Controller
{
    public function __construct(protected MachingService $service)
    {
    }
    public function requestMatching(int $matchFrom, int $matchTo)
    {
        try {
            $this->service->requestMatching($matchFrom, $matchTo);

            return response()->json(["Request to match Sent Successfully"]);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function updateMatching($matchFrom, $matchTo)
    {
        try {
            $this->service->updateMatching($matchFrom, $matchTo);

            return response()->json(["Matching Accepted"]);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function listMatching(int $linkaUser)
    {
        try {
            $result = $this->service->listMatching($linkaUser);

            return response()->json($result);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function declineMatching(int $matchFrom, int $matchTo)
    {
        try {
            $this->service->declineMatching($matchFrom, $matchTo);

            return response()->json(["Requested Matching has been declined"]);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }
}
