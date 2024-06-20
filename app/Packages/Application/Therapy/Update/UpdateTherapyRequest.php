<?php

namespace App\Packages\Application\Therapy\Update;

use Exception;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class UpdateTherapyRequest{


    protected $id;
    protected $name;


    public function __construct(Request $request)
    {
        $this->id = $request->input('id');
        $this->name = $request->input('data');
        $this->validate($request);
    }

    public function validate(Request $request){
        $rules = [
            'id'=>'required',
            'data'=>'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            throw new Exception('Validation failed: ' . implode(', ', $validator->errors()->all()));
        }
    }

    public function getID(){

        return $this->id;

    }

    public function getName(){

        return $this->name;
    }
}