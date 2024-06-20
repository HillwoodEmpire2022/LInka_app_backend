<?php

namespace App\Packages\Application\AppointmentVerification\Update;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateVerificationRequest{

    protected $id;
    protected $appointmentDate;
    protected $therapistAssigned;
    protected $appointmentStatus;


    public function __construct(Request $request)
    {
        $this->id = $request->input('id');
        $this->appointmentDate = $request->input('appointment_date');
        $this->therapistAssigned = $request->input('therapist_assigned');
        $this->appointmentStatus = $request->input('appointment_status');
        $this->validate($request);
    }

    public function validate(Request $request){
        $rules = [
            'id'=>'required',
            'appointment_date'=>'required',
            'therapist_assigned'=>'required',
            'appointment_status'=>'required|string|max:50',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            throw new Exception('Validation failed: ' . implode(', ', $validator->errors()->all()));
        }
    }

    public function getID(){
        return $this->id;
    }

    public function getAppointmentDate(){
        return $this->appointmentDate;
    }

    public function getTherapistAssigned(){
        return $this->therapistAssigned;
    }

    public function getAppointmentStatus(){
        return $this->appointmentStatus;
    }
}