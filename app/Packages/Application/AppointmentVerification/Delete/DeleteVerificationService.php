<?php

namespace App\Packages\Application\AppointmentVerification\Delete;

use App\Packages\Application\Therapy\Find\FindOneTherapyRequest;
use App\Packages\Infrastructure\AppointmentVerificationRepository;

class DeleteVerificationService{

    protected $id;
    protected $verificationRepository;

    public function __construct(FindOneTherapyRequest $findOneTherapyRequest, AppointmentVerificationRepository $verificationRepository)
    {
        $this->id = $findOneTherapyRequest->getID();
        $this->verificationRepository = $verificationRepository;
    }

    public function deleteVerification(){
        return $this->verificationRepository->deleteVerification($this->id);
    }
}