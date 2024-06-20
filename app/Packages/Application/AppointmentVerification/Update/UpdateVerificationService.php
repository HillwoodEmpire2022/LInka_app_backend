<?php

namespace App\Packages\Application\AppointmentVerification\Update;
use App\Packages\Application\AppointmentVerification\Update\UpdateVerificationRequest;
use App\Packages\Infrastructure\AppointmentVerificationRepository;

class UpdateVerificationService{

    protected $verificationRepository;
    protected $id;
    protected $appointmentDate;
    protected $therapistAssigned;
    protected $appointmentStatus;

    public function __construct(UpdateVerificationRequest $updateVerificationRequest, AppointmentVerificationRepository $verificationRepository)
    {
        $this->id = $updateVerificationRequest->getID();
        $this->appointmentDate = $updateVerificationRequest->getAppointmentDate();
        $this->therapistAssigned = $updateVerificationRequest->getTherapistAssigned();
        $this->appointmentStatus = $updateVerificationRequest->getAppointmentStatus();
        $this->verificationRepository = $verificationRepository;
    }

    public function updateVerification(){
        return $this->verificationRepository->updateVerification($this->id, ['Appointment_date'=>$this->appointmentDate, 'Therapist_Assigned'=>$this->therapistAssigned, 'Appointment_Status'=>$this->appointmentStatus]);
    }
}