<?php

namespace App\Packages\Application\Appointment\Delete;
use App\Packages\Application\Therapy\Find\FindOneTherapyRequest;
use App\Packages\Infrastructure\AppointmentRepository;

class DeleteAppointmentService{

    protected $id;
    protected $appointmentRepository;

    public function __construct(FindOneTherapyRequest $findOneTherapyRequest, AppointmentRepository $appointmentRepository)
    {

        $this->id=$findOneTherapyRequest->getID();
        $this->appointmentRepository=$appointmentRepository;

    }

    public function deleteAppointment(){

        return $this->appointmentRepository->deleteAppointment($this->id);
        
    }
}