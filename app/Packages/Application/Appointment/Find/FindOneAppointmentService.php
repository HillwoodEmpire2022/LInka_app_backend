<?php

namespace App\Packages\Application\Appointment\Find;
use App\Packages\Application\Therapy\Find\FindOneTherapyRequest;
use App\Packages\Infrastructure\AppointmentRepository;

class FindOneAppointmentService{

    protected $id;
    protected $appointmentRepository;

    public function __construct(FindOneTherapyRequest $findOneTherapyRequest, AppointmentRepository $appointmentRepository)
    {
        $this->id=$findOneTherapyRequest->getID();
        $this->appointmentRepository=$appointmentRepository;
    }

    public function findAppointment(){

        return $this->appointmentRepository->getOneAppointment($this->id);
    }
}