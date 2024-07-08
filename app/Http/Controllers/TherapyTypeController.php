<?php

namespace App\Http\Controllers;

use App\Packages\Application\Therapy\Find\FindOneTherapyRequest;
use App\Packages\application\TherapyType\All\GetAllTherapyTypeService;
use App\Packages\Application\TherapyType\Create\CreateTherapyTypeRequest;
use App\Packages\Application\TherapyType\Create\CreateTherapyTypeService;
use App\Packages\Application\TherapyType\Delete\DeleteTherapyTypeService;
use App\Packages\Application\TherapyType\Find\FindOneTherapyTypeService;
use App\Packages\Application\TherapyType\Update\UpdateTherapyTypeRequest;
use App\Packages\Application\TherapyType\Update\UpdateTherapyTypeService;
use Illuminate\Http\Request;

class TherapyTypeController extends Controller
{
    
    public function createTherapyType(Request $request, CreateTherapyTypeService $createTherapyTypeService){

        $therapyRequest = new CreateTherapyTypeRequest($request);
        return $createTherapyTypeService->createTherapyType($therapyRequest);

    }

    public function allTherapyType(GetAllTherapyTypeService $allTherapyTypeService){

        return $allTherapyTypeService->allTherapist();

    }
    
    public function findTherapyType(Request $request, FindOneTherapyTypeService $findOneTherapyTypeService){

        $therapyRequest = new FindOneTherapyRequest($request);
        return $findOneTherapyTypeService->findOneTherapyType($therapyRequest);
    }

    public function updateTherapyType(Request $request, UpdateTherapyTypeService $updateTherapyTypeService){

        $therapyRequest = new UpdateTherapyTypeRequest($request);
        return $updateTherapyTypeService->updateTherapyType($therapyRequest);
    }

    public function deleteTherapyType(Request $request, DeleteTherapyTypeService $deleteTherapyTypeService){

        $therapyRequest = new FindOneTherapyRequest($request);
        return $deleteTherapyTypeService->deleteTherapyType($therapyRequest);
        
    }
}
