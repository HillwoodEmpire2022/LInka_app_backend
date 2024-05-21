<?php

namespace App\Packages\Application\Chatting\Send;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class ChattingRequest
{

    protected $chatting;
    protected $content;
    protected $senderID;
    protected $receiverID;
   

    public function __construct(Request $request)
    {

        $this->validate($request);
        $this->content = $request->input('content');
        $this->senderID = $request->input('senderID');
        $this->receiverID = $request->input('receiverID');
    }

    public function validate(Request $request){

        $rules = [
            // 'content'=> 'required|string|max:1000',
            'senderID'=> 'required|integer|exists:users,id',
            'receiverID'=> 'required|integer|exists:users,id',
        ];
        $validator =Validator::make($request->all(), $rules);
        if ($validator->fails()){
            throw new Exception('Validation failed: ' . implode(', ', $validator->errors()->all()));
        }

    }


    public function content()
    {
        return $this->content;   
    }

    public function senderID()
    {
        return $this->senderID;   
    }

    public function receiverID()
    {
        return $this->receiverID;   
    }
}


