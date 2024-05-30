<?php

namespace App\Packages\Infrastructure;
use App\Models\AppointmentVerification;


class AppointmentVerificationRepository{

    protected $appointmentVerificationModel;


    public function __construct()
    {
        $this->appointmentVerificationModel = new AppointmentVerification(); 
    }

    public function createVerification(string $linkerUserID, string $appointmentDate, string $therapyType, string $therapistAssigned, string $appointmentStatus){
        return $this->appointmentVerificationModel::create([
            'LinkerUserID'=>$linkerUserID,
            'Appointment_date'=>$appointmentDate,
            'TherapyType'=>$therapyType,
            'Therapist_Assigned'=>$therapistAssigned,
            'Appointment_Status'=>$appointmentStatus,
        ]);
    }

    public function allVerification(){
        return $this->appointmentVerificationModel->get();
    }

    public function findVerification(string $id){
        return $this->appointmentVerificationModel::where('id', $id);
    }

    public function updateVerification(string $id, array $data){
        $verificationID = $this->appointmentVerificationModel::findOrFail($id);
        return $verificationID->update($data);
    }

    public function deleteVerification(string $id){
        return $this->appointmentVerificationModel->destroy($id);
    }
}