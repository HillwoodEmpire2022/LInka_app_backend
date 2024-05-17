<?php

namespace App\Packages\Application\Chatting\Text\Update;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;

class UpdateChatRequest{

    protected $message_id;
    protected $content;

    public function __construct(Request $request)
    {
        $this->validate($request);
        $this->message_id=$request->input('message_id');
        $this->content=$request->input('content');

      
    }

    public function validate(Request $request){
        $rules = [
            'message_id'=>'required|integer|users,id',
            'content'=>'required|string|max:1000',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            throw new Exception('Validation failed: ' . implode($validator->errors()->all()));
        }
    }

    public function getMessageID(){

        return $this->message_id;
    }

    public function getContent(){
        return $this->content;
    }
}