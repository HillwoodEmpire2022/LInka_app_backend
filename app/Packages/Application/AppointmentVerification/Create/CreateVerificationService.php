<?php

namespace App\Packages\Application\AppointmentVerification\Create;
use App\Packages\Application\AppointmentVerification\Create\CreateVerificationRequest;
use App\Packages\Infrastructure\AppointmentVerificationRepository;

class CreateVerificationService{

    protected $verificationRepository;
    protected $linkerUserID;
    protected $appointmentDate;
    protected $therapyType;
    protected $therapistAssigned;
    protected $appointmentStatus;

    public function __construct(CreateVerificationRequest $createVerificationRequest, AppointmentVerificationRepository $verificationRepository)
    {
        $this->linkerUserID = $createVerificationRequest->getLinkerUser();
        $this->appointmentDate = $createVerificationRequest->getAppointmentDate();
        $this->therapyType = $createVerificationRequest->getTherapyType();
        $this->therapistAssigned = $createVerificationRequest->getTherapistAssigned();
        $this->appointmentStatus = $createVerificationRequest->getAppointmentStatus();
        $this->verificationRepository = $verificationRepository;
    }

    public function createVerification(){
        return $this->verificationRepository->createVerification($this->linkerUserID, $this->appointmentDate, $this->therapyType, $this->therapistAssigned, $this->appointmentStatus);
    }
}