<?php

namespace App\Services;

use App\Models\LinkaUsers;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ProfileService
{
    public function createProfile(string $firstName, string $lastName, string $nickName,
        string $age, string $gender,
        $height, $weight, $personalInfo,
        $sexualOrientation, string $lookingFor,
        string $lookingDescription, string $profileImagePath, int $linkaUserID) {

        $createProfile = DB::transaction(function () use ($firstName, $lastName, $nickName,
            $age, $gender, $height,
            $weight, $personalInfo, $sexualOrientation,
            $lookingFor, $lookingDescription, $profileImagePath, $linkaUserID) {

            $linkaUser = $this->validatelinkaUser($linkaUserID);

            // dd($linkaUser);

            Profile::create([
                "linka_user_id" => $linkaUser,
                "firstName" => $firstName,
                "lastName" => $lastName,
                "nickName" => $nickName,
                "age" => $age,
                "gender" => $gender,
                "country" => "Rwanda",
                "height" => $height,
                "weight" => $weight,
                "personalInfo" => $personalInfo,
                "sexualOrientation" => $sexualOrientation,
                "lookingFor" => $lookingFor,
                "lookingDescription" => $lookingDescription,
                "profileImagePath" => $profileImagePath,
            ]);
        });

        return $createProfile;
    }

    public function updateProfile(string $firstName, string $lastName, string $nickName,
        string $age, string $gender,
        $height, $weight, $personalInfo,
        $sexualOrientation, string $lookingFor,
        string $lookingDescription, int $linkaUserID) {

        $updateProfile = DB::transaction(function () use ($firstName, $lastName, $nickName,
            $age, $gender, $height,
            $weight, $personalInfo, $sexualOrientation,
            $lookingFor, $lookingDescription, $linkaUserID) {

            $profile = Profile::where("linka_user_id", $linkaUserID)->first();

            $profileUserID = $profile->id;

            Profile::where("id", $profileUserID)->update([
                "firstName" => $firstName,
                "lastName" => $lastName,
                "nickName" => $nickName,
                "age" => $age,
                "gender" => $gender,
                "country" => "Rwanda",
                "height" => $height,
                "weight" => $weight,
                "personalInfo" => $personalInfo,
                "sexualOrientation" => $sexualOrientation,
                "lookingFor" => $lookingFor,
                "lookingDescription" => $lookingDescription,
            ]);
        });

        return $updateProfile;
    }

    public function listProfile()
    {
        $listProfile = Profile::select('Profile.firstName', 'Profile.lastName', 'Profile.height', 'Profile.weight',
            'Profile.personalInfo', 'Profile.sexualOrientation', 'Profile.lookingFor',
            'Profile.lookingDescription', 'Profile.profileImagePath', 'LinkaUsers.id')
            ->join('LinkaUsers', 'Profile.linka_user_id', '=', 'LinkaUsers.id')
            ->get();

        $processedResults = $listProfile->map(function ($result) {
            return [
                'userID' => $result->id,
                'firstName' => $result->firstName,
                'lastName' => $result->lastName,
                'height' => $result->height,
                'weight' => $result->weight,
                'personalInfo' => $result->personalInfo,
                'sexualOrientation' => $result->sexualOrientation,
                'lookingFor' => $result->lookingFor,
                'lookingDescription' => $result->lookingFor,
                'profileImagePath' => env('APP_URL') . '/' . 'storage/' . $result->profileImagePath,
            ];
        });

        return $processedResults;
    }

    public function profileDetails(int $userID)
    {
        $listProfileDetails = Profile::select('Profile.firstName', 'Profile.lastName', 'Profile.height', 'Profile.weight',
            'Profile.personalInfo', 'Profile.sexualOrientation', 'Profile.lookingFor',
            'Profile.lookingDescription', 'Profile.profileImagePath', 'LinkaUsers.id')
            ->join('LinkaUsers', 'Profile.linka_user_id', '=', 'LinkaUsers.id')
            ->where('Profile.linka_user_id', $userID)
            ->get();

        $processedResults = $listProfileDetails->map(function ($result) {
            return [
                'userID' => $result->id,
                'firstName' => $result->firstName,
                'lastName' => $result->lastName,
                'height' => $result->height,
                'weight' => $result->weight,
                'personalInfo' => $result->personalInfo,
                'sexualOrientation' => $result->sexualOrientation,
                'lookingFor' => $result->lookingFor,
                'lookingDescription' => $result->lookingFor,
                'profileImagePath' => env('APP_URL') . '/' . 'storage/' . $result->profileImagePath,
            ];
        });

        return $processedResults;
    }

    public function disableProfile()
    {

    }

    public function validatelinkaUser(int $linkaUserID)
    {
        $linkaUser = LinkaUsers::where("id", $linkaUserID)->first();

        if ($linkaUser) {

            return $linkaUser->id;
        }

        throw new HttpException(404, "User member does not exist");

    }
}
