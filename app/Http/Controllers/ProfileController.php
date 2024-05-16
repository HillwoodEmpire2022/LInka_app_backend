<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\ProfileService;

class ProfileController extends Controller
{
    public function __construct(protected ProfileService $service)
    {
    }
    
    public function createProfile(CreateProfileRequest $request, $linkaUserID)
    {
        try {
            $file = $request->file('profileImagePath');

            if ($file) {

                $nameFileProfile = $file->getClientOriginalName();

                $file->storeAs('public', $nameFileProfile);

                $this->service->createProfile($request->firstName, $request->lastName, $request->nickName,
                    $request->age, $request->gender,
                    $request->height, $request->weight, $request->personalInfo,
                    $request->sexualOrientation, $request->lookingFor, $request->lookingDescription,
                    $nameFileProfile, $linkaUserID);

                return response()->json(["Profile Created Successfully"]);

            } else {

                return response()->json(["failed to upload Profile file image and description, please try again"]);
            }
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function updateProfile(UpdateProfileRequest $request, $linkaUserID)
    {
        try {

            $this->service->updateProfile($request->firstName, $request->lastName, $request->nickName,
                $request->age, $request->gender,
                $request->height, $request->weight, $request->personalInfo,
                $request->sexualOrientation, $request->lookingFor, $request->lookingDescription, $linkaUserID);

            return response()->json(["Profile Updated Successfully"]);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function listProfile()
    {
        try {
            $result = $this->service->listProfile();

            return response()->json($result);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function profileDetails(int $userID)
    {
        try {
            $result = $this->service->profileDetails($userID);

            return response()->json($result);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function disableProfile()
    {
        try {
            //code...
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }
}
