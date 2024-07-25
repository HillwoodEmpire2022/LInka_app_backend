<?php

namespace App\Http\Controllers;
use App\Packages\Application\UsersLocation\UsersLocationRequest;
use App\Packages\Application\UsersLocation\UsersLocationService;
use App\PAckages\Application\UsersLocation\AllUsersLocationService;
use Illuminate\Http\Request;

class UserLocationController extends Controller
{
    public function locationCreateOrUpdate(Request $request,UsersLocationService $usersLocationService){
        $userlocation = new UsersLocationRequest($request);
        return $usersLocationService->creatingLocation($userlocation);
    }

    public function getlocation(AllUsersLocationService $allUsersLocationService){
        return $allUsersLocationService->getLocation();
    }
}
