<?php

namespace App\Packages\Application\AppointmentVerification\All;

use App\Packages\Infrastructure\AppointmentVerificationRepository;

class AllVerificationService{

    protected $verificationRepository;


    public function __construct(AppointmentVerificationRepository $verificationRepository)
    {
        $this->verificationRepository = $verificationRepository;
    }

    public function allVerification(){
        return $this->verificationRepository->allVerification();
    }
}