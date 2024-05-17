<?php

namespace App\Packages\Application\Chatting\Text\Delete;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;


class DeleteChatRequest{

    protected $message_id;

    public function __construct(Request $request)
    {
        $this->validate($request);
        $this->message_id=$request->input('message_id');
       
    }

    public function validate(Request $request){
        $rules = [
            'message_id'=>'required|integer|users,id',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            throw new Exception('Validation failed: ' . implode($validator->errors()->all()));
        }
    }

    public function getID(){

        return $this->message_id;
    }
}