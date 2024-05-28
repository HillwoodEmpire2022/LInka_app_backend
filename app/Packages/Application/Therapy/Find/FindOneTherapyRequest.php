<?php

namespace App\Packages\Application\Therapy\Find;

use Exception;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class FindOneTherapyRequest{


    protected $id;

    public function __construct(Request $request)
    {
        $this->id = $request->input('id');
        $this->validate($request);
    }

    public function validate(Request $request){

        $rules = [
            'id'=>'Required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            throw new Exception('Validation failed: ' . implode(', ', $validator->errors()->all()));
        }
    }

    public function getID(){

        return $this->id;
    }
}