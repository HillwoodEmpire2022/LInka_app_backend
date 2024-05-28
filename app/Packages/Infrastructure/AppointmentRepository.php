<?php

namespace App\Packages\Infrastructure;
use App\Models\AppointmentRequest;


class AppointmentRepository{

    protected $appointmentModel;


    public function __construct()
    {
        $this->appointmentModel = new AppointmentRequest();
    }

    public function createAppointment(string $full_name, string $age, string $location, string $gender, string $message, string $phone_number, string $therapy_needed){

        return $this->appointmentModel::create([
            'Full_name'=>$full_name,
            'Age'=>$age,
            'Location'=>$location,
            'Gender'=>$gender,
            'Message'=>$message,
            'Phone_number'=>$phone_number,
            'TherapyType_needed'=>$therapy_needed,
        ]);
    }

    public function getAllAppointment(){

        return $this->appointmentModel->get();
    }

    public function getOneAppointment(string $id){

        return $this->appointmentModel->where('id', $id)->get();

    }

    public function updateAppointment(string $id, array $data){

        $appontmentID = $this->appointmentModel::findOrFail($id);
        return $appontmentID->update($data);

    }

    public function deleteAppointment(string $id){

        return $this->appointmentModel->destroy($id);
        
    }
}