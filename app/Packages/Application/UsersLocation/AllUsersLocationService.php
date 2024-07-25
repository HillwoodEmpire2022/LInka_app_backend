<?php

namespace App\Packages\Application\UsersLocation;
use App\Packages\Infrastructure\UsersLocationRepository;


class AllUsersLocationService{

    protected $locationRepository;

    public function __construct(UsersLocationRepository $usersLocationRepository)
    {
        $this->locationRepository = $usersLocationRepository;
    }

    public function getLocation(){
        return $this->locationRepository->getLocation();
    }
}