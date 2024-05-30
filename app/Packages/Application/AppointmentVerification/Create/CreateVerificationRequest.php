<?php

namespace App\Packages\Application\AppointmentVerification\Create;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreateVerificationRequest{

    protected $linkerUserID;
    protected $appointmentDate;
    protected $therapyType;
    protected $therapistAssigned;
    protected $appointmentStatus;


    public function __construct(Request $request)
    {
        $this->linkerUserID = $request->input('linkerUser_id');
        $this->appointmentDate = $request->input('appointment_date');
        $this->therapyType = $request->input('therapy_type');
        $this->therapistAssigned = $request->input('therapist_assigned');
        $this->appointmentStatus = $request->input('appointment_status');
        $this->validate($request);
    }

    public function validate(Request $request){
        $rules = [
            'linkerUser_id'=>'required',
            'appointment_date'=>'required',
            'therapy_type'=>'required',
            'therapist_assigned'=>'required',
            'appointment_status'=>'required|string|max:50',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            throw new Exception('Validation failed: ' . implode(', ', $validator->errors()->all()));
        }
    }

    public function getLinkerUser(){
        return $this->linkerUserID;
    }

    public function getAppointmentDate(){
        return $this->appointmentDate;
    }

    public function getTherapyType(){
        return $this->therapyType;
    }

    public function getTherapistAssigned(){
        return $this->therapistAssigned;
    }

    public function getAppointmentStatus(){
        return $this->appointmentStatus;
    }
}