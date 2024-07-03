<?php

namespace App\Packages\Application\Appointment\Update;
use App\Packages\Application\Therapy\Update\UpdateTherapyRequest;
use App\Packages\Infrastructure\AppointmentRepository;

class UpdateAppointmentService{

    protected $id;
    protected $data;
    protected $appointmentRepository;


    public function __construct(UpdateTherapyRequest $updateTherapyRequest, AppointmentRepository $appointmentRepository)
    {
        $this->id=$updateTherapyRequest->getID();
        $this->data=$updateTherapyRequest->getName();
        $this->appointmentRepository=$appointmentRepository;

    }

    public function updateAppointment(){

        return $this->appointmentRepository->updateAppointment($this->id, ['TherapyType_needed'=>$this->data]);

    }
}