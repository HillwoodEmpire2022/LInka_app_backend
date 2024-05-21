<?php

namespace App\Packages\Application\Chatting\Text\List;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;

class ChattListRequest{

    protected $chatting;
    protected $senderID;
    protected $receiverID;

    public function __construct(Request $request)
    {
        $this->validate($request);
        $this->senderID = $request->input('senderID');
        
    }

    public function validate(Request $request){
        $rules = [
            'senderID'=>'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            throw new Exception('Validation failed: ' . implode($validator->errors()->all()));
        }
    }

    public function senderID()
    {
        return $this->senderID;   
    }
}