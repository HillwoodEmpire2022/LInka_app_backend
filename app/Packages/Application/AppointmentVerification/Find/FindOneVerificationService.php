<?php

namespace App\Packages\Application\AppointmentVerification\Find;

use App\Packages\Application\Therapy\Find\FindOneTherapyRequest;
use App\Packages\Infrastructure\AppointmentVerificationRepository;

class FindOneVerificationService{

    protected $id;
    protected $verificationRepository;

    public function __construct(FindOneTherapyRequest $findOneTherapyRequest, AppointmentVerificationRepository $verificationRepository)
    {
        $this->id = $findOneTherapyRequest->getID();
        $this->verificationRepository = $verificationRepository;
    }

    public function findVerification(){
        return $this->verificationRepository->findVerification($this->id);
    }
}