<?php

namespace App\Packages\Application\Therapist\Create;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreateTherapistRequest{

    protected $full_name;
    protected $specialization;
    protected $phone_number;

    public function __construct(Request $request)
    {
        $this->full_name = $request->input('full_name');
        $this->specialization = $request->input('specialization');
        $this->phone_number = $request->input('phone_number');
        $this->validate($request);
    }

    public function validate(Request $request){
        $rules = [
            'full_name'=>'required|string|max:100',
            'specialization'=>'required|string|max:500',
            'phone_number'=>'required|string|max:30',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            throw new Exception('Validation failed: ' . implode(', ', $validator->errors()->all()));
        }
    }

    public function getFull_name(){
        return $this->full_name;
    }

    public function getSpecialization(){
        return $this->specialization;
    }

    public function getPhone_number(){
        return $this->phone_number;
    }
}