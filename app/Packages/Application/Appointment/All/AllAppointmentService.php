<?php

namespace App\Packages\Application\Appointment\All;
use App\Packages\Infrastructure\AppointmentRepository;

class AllAppointmentService{

    protected $appointmentRepository;

    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointmentRepository=$appointmentRepository;
    }

    public function getAllAppointment(){

        return $this->appointmentRepository->getAllAppointment();
    }
}