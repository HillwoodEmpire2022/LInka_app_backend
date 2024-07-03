<?php

namespace App\Packages\Application\Appointment\Create;
use App\Packages\Application\Appointment\Create\CreateAppointmentRequest;
use App\Packages\Infrastructure\AppointmentRepository;

class CreateAppointmentService{

    protected $full_name;
    protected $age;
    protected $location;
    protected $gender;
    protected $message;
    protected $phone_number;
    protected $therapy_needed;
    protected $appointmentRepository;


    public function __construct(CreateAppointmentRequest $createAppointmentRequest, AppointmentRepository $appointmentRepository)
    {
        $this->full_name=$createAppointmentRequest->getFull_name();
        $this->age=$createAppointmentRequest->getage();
        $this->location=$createAppointmentRequest->getlocation();
        $this->gender=$createAppointmentRequest->getgender();
        $this->message=$createAppointmentRequest->getmessage();
        $this->phone_number=$createAppointmentRequest->getPhone_number();
        $this->therapy_needed=$createAppointmentRequest->getTherapy_needed();

        $this->appointmentRepository=$appointmentRepository;
    }

    public function createAppointment(){

        return $this->appointmentRepository->createAppointment($this->full_name, $this->age, $this->location, $this->gender, $this->message, $this->phone_number, $this->therapy_needed);
        
    }
}