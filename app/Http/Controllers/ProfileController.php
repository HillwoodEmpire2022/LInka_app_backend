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
    /**
     * @OA\Post(
     *     path="/api/profile/create/1",
     *     operationId="profile create",
     *     tags={"Prifile"},
     *     summary="Create a new profile member",
     *     description="Register a new Profile member",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Profile Details",
     *         @OA\JsonContent(
     *             required={"firstName", "lastName", "nickName", "age", "gender", "country", "lookingFor", "lookingDescription", "profileImagePath"},
     *             @OA\Property(property="firstName", type="text", example="Heritier"),
     *             @OA\Property(property="lastName", type="text", format="text", example="Ganza"),
     *             @OA\Property(property="nickName", type="text", format="text", example="Tamba"),
     *             @OA\Property(property="age", type="number", format="text", example="25"),
     *             @OA\Property(property="gender", type="text", format="text", example="Male"),
     *             @OA\Property(property="country", type="text", format="text", example="Rwanda"),
     *             @OA\Property(property="height", type="number", format="text", example="173"),
     *             @OA\Property(property="weight", type="number", format="text", example="76"),
     *             @OA\Property(property="personalInfo", type="text", format="text", example="I'm looking for a girlfriend"),
     *             @OA\Property(property="sexualOrientation", type="text", format="text", example="bisexual"),
     *             @OA\Property(property="lookingFor", type="text", format="text", example="Relationship"),
     *             @OA\Property(property="lookingDescription", type="text", format="text", example="Looking for a long term Relationship"),
     *             @OA\Property(property="profileImagePath", type="text", format="file", example="")
     *
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Profile Created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="Profile Created Successfully", type="string"),
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
