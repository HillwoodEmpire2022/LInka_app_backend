<?php

namespace App\Packages\Application\UsersLocation;
use App\Packages\Application\UsersLocation\UsersLocationRequest;
use App\Packages\Infrastructure\UsersLocationRepository;


class UsersLocationService{

    protected $locationRepository;
    protected $latitude;
    protected $longitude;
    protected $user_id;

    public function __construct(UsersLocationRequest $request, UsersLocationRepository $usersLocationRepository)
    {
        $this->user_id = $request->getID();
        $this->latitude = $request->getLatitude();
        $this->longitude = $request->getLongitude();
        $this->locationRepository = $usersLocationRepository;
    }

    public function creatingLocation(){
        return $this->locationRepository->createOrUpdateLocation($this->user_id, $this->latitude, $this->longitude);
    }
}