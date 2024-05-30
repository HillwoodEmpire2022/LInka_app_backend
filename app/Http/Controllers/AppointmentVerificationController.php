<?php

namespace App\Http\Controllers;

use App\Packages\Application\AppointmentVerification\All\AllVerificationService;
use App\Packages\Application\AppointmentVerification\Create\CreateVerificationRequest;
use App\Packages\Application\AppointmentVerification\Create\CreateVerificationService;
use App\Packages\Application\AppointmentVerification\Delete\DeleteVerificationService;
use App\Packages\Application\AppointmentVerification\Find\FindOneVerificationService;
use App\Packages\Application\AppointmentVerification\Update\UpdateVerificationRequest;
use App\Packages\Application\AppointmentVerification\Update\UpdateVerificationService;
use App\Packages\Application\Therapy\Find\FindOneTherapyRequest;
use Illuminate\Http\Request;

class AppointmentVerificationController extends Controller
{
    

    public function createVerification(Request $request, CreateVerificationService $createVerificationService){
        $verificationRequest = new CreateVerificationRequest($request);
        return $createVerificationService->createVerification($verificationRequest);
    }

    public function allVerification(AllVerificationService $allVerificationService){
        return $allVerificationService->allVerification();
    }

    public function findVerification(Request $request, FindOneVerificationService $findOneVerificationService){
        $verificationRequest = new FindOneTherapyRequest($request);
        return $findOneVerificationService->findVerification($verificationRequest);
    }

    public function updateVerification(Request $request, UpdateVerificationService $updateVerificationService){
        $verificationRequest = new UpdateVerificationRequest($request);
        return $updateVerificationService->updateVerification($verificationRequest);
    }

    public function deleteVerification(Request $request, DeleteVerificationService $deleteVerificationService){
        $verificationRequest = new FindOneTherapyRequest($request);
        return $deleteVerificationService->deleteVerification($verificationRequest);
    }
}
