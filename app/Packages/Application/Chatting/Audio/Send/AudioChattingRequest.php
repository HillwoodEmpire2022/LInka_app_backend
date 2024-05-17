<?php

namespace App\Packages\Application\Chatting\Audio\Send;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AudioChattingRequest
{

    protected $audioUrl;
    protected $senderID;
    protected $receiverID;
    protected $conversationID;

    public function __construct(Request $request)
    {
        $this->validate($request);
        $this->audioUrl = $request->file('audio');
        $this->senderID = $request->input('senderID');
        $this->receiverID = $request->input('receiverID');
       
    }

    public function validate(Request $request){
        $rules = [
            'audio'=>'required|audio|mimes:mpeg,ogg,wav|max:25600',
            'senderID'=>'required|integer|exists:users,id',
            'receiverID'=>'required|integer|exists,id',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            throw new Exception('Validation failed: ' . implode(', ', $validator->errors()->all()));
        }

    }


    public function audioUrl()
    {
        return $this->audioUrl;   
    }

    public function senderID()
    {
        return $this->senderID;   
    }

    public function receiverID()
    {
        return $this->receiverID;   
    }

    public function convoID()
    {
        return $this->conversationID;   
    }
}