<?php

namespace App\Packages\Application\UsersLocation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Exception;


class UsersLocationRequest{

    protected $latitude;
    protected $longitute;
    protected $user_id;

    public function __construct(Request $request)
    {
        $this->user_id = $request->input('user_id');
        $this->latitude = $request->input('latitude');
        $this->longitute = $request->input('longitude'); 
        $this->validate($request);
    }

    public function validate(Request $request){

        $rules = [
            'user_id'=>'required',
            'latitude'=>'required|numeric',
            'longitude'=>'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            throw new Exception('Validation Failed: ' . implode(', ', $validator->errors()->all()));
        }

    }

    public function getID(){
        return $this->user_id;
    }

    public function getLatitude(){
        return $this->latitude;
    }

    public function getLongitude(){
        return $this->longitute;
    }
}