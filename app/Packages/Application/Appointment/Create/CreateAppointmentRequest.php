<?php

namespace App\Packages\Application\Appointment\Create;

use Exception;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class CreateAppointmentRequest{

    protected $full_name;
    protected $age;
    protected $location;
    protected $gender;
    protected $message;
    protected $phone_number;
    protected $therapy_needed;


    public function __construct(Request $request)
    {

        $this->validate($request);
        $this->full_name=$request->input('full_name');
        $this->age=$request->input('age');
        $this->location=$request->input('location');
        $this->gender=$request->input('gender');
        $this->message=$request->input('message');
        $this->phone_number=$request->input('phone_number');
        $this->therapy_needed=$request->input('therapy_needed');

    }

    public function validate(Request $request){

        $rules = [
            'full_name'=>'required|string|max:100',
            'age'=>'required|int',
            'location'=>'required|string|max:300',
            'gender'=>'required|string|max:10',
            'message'=>'required|string|max:500',
            'phone_number'=>'required|string|max:30',
            'therapy_needed'=>'required',
        ];
        $validator =Validator::make($request->all(), $rules);
        if ($validator->fails()){
            throw new Exception('Validation failed: ' . implode(', ', $validator->errors()->all()));
        }
    }

    public function getFull_name(){
        return $this->full_name;
    }

    
    public function getage(){
        return $this->age;
    }

    
    public function getlocation(){
        return $this->location;
    }

    
    public function getgender(){
        return $this->gender;
    }

    
    public function getmessage(){
        return $this->message;
    }

    
    public function getPhone_number(){
        return $this->phone_number;
    }

    
    public function getTherapy_needed(){
        return $this->therapy_needed;
    }
}