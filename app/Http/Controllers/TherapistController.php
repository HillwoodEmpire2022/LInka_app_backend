<?php

namespace App\Http\Controllers;

use App\Packages\Application\Therapist\All\AllTherapistService;
use App\Packages\Application\Therapist\Create\CreateTherapistRequest;
use App\Packages\Application\Therapist\Create\CreateTherapistService;
use App\Packages\Application\Therapist\Delete\DeleteTherapistService;
use App\Packages\Application\Therapist\Find\FindOneTherapistService;
use App\Packages\Application\Therapist\Update\UpdateTherapistRequest;
use App\Packages\Application\Therapist\Update\UpdateTherapistService;
use App\Packages\Application\Therapy\Find\FindOneTherapyRequest;
use Illuminate\Http\Request;

class TherapistController extends Controller
{
    
    public function createTherapist(Request $request, CreateTherapistService $createTherapistService){
        $therapistRequest = new CreateTherapistRequest($request);
        return $createTherapistService->createTherapist($therapistRequest);
    }

    public function allTherapist(AllTherapistService $allTherapistService){
        return $allTherapistService->allTherapist();
    }

    public function findTherapist(Request $request, FindOneTherapistService $findOneTherapistService){
        $therapistRequest = new FindOneTherapyRequest($request);
        return $findOneTherapistService->oneTherapist($therapistRequest);
    }

    public function updateTherapist(Request $request, UpdateTherapistService $updateTherapistService){
        $therapistRequest = new UpdateTherapistRequest($request);
        return $updateTherapistService->updateTherapist($therapistRequest);
    }

    public function deleteTherapist(Request $request, DeleteTherapistService $deleteTherapistService){
        $therapistRequest = new FindOneTherapyRequest($request);
        return $deleteTherapistService->deleteTherapist($therapistRequest);
    }
}
