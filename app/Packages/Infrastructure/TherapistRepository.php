<?php

namespace App\Packages\Infrastructure;
use App\Models\Therapist;
use App\Models\AppointmentVerification;


class TherapistRepository{

    protected $therapistModels;
    protected $verificationModels;

    public function __construct()
    {
        $this->therapistModels = new Therapist();
        $this->verificationModels = new AppointmentVerification();
    }

    public function createTherapist(string $full_name, string $specialization, string $phone_number, ){

        return $this->therapistModels::create([
            'Full_names'=>$full_name,
            'Specialization'=>$specialization,
            'Phone_ontact'=>$phone_number,
        ]);

    }

    public function getAllTherapist(){

        return $this->therapistModels->get();

    }

    public function getOneTherapist(int $id){

        $therapistInfo = $this->therapistModels->where('id', $id)->select('Full_names', 'Specialization', 'Phone_ontact')->first();
        $appointmentData = $this->verificationModels->where('Therapist_Assigned', $id)->select('Full_name', 'Appointment_date', 'consultation_type', 'Appointment_Status')->get();
        return response([
            'Therapist Info'=>$therapistInfo,
            'Appointment Info'=>$appointmentData,
        ]);

    }

    public function updateTherapist(int $id, array $data){

        $therapyID = $this->therapistModels::findOrFail($id);
        return $therapyID->update($data);

    }

    public function deleteTherapist(int $id){

        return $this->therapistModels->destroy($id);
        
    }
}