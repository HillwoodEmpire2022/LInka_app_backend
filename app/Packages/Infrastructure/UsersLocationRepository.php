<?php

namespace App\Packages\Infrastructure;
use Illuminate\Support\Facades\Auth;
use App\Models\UsersLocation;


class UsersLocationRepository{

    protected $locationmodel;

    public function  __construct()
    {
        $this->locationmodel = new UsersLocation();
    }

    public function createOrUpdateLocation($user_id, $latitude, $longitude){
        $userLocation = $this->locationmodel::updateOrCreate([
            // 'users_id'=>Auth::id(),
            'users_id'=>$user_id,
            'latitude'=>$latitude,
            'longitude'=>$longitude
        ]);

        return response()->json(['message'=>'Location Updated successfully', 'location'=>$userLocation]);
    }

    public function getLocation(){
        $locations = $this->locationmodel::all();

        return response()->json($locations);
    }
}