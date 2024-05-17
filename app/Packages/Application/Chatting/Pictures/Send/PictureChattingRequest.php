<?php

namespace App\Packages\Application\Chatting\Pictures\Send;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PictureChattingRequest
{

    protected $imageUrl;
    protected $senderID;
    protected $receiverID;
   

    public function __construct(Request $request)
    {
        $this->validate($request);
        $this->imageUrl = $request->file('image');
        $this->senderID = $request->input('senderID');
        $this->receiverID = $request->input('receiverID');
    }


    public function validate(Request $request)
    {

        $rules =  [
            'image' => 'required|image|mimes:jpeg,jpg,png,gif|max:25600',
            'senderID' => 'required|integer|exists:users,id',
            'receiverID' => 'required|integer|exists:users,id',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            throw new Exception('Validation failed: ' . implode(', ', $validator->errors()->all()));
        }
    }



    public function imageUrl()
    {
        return $this->imageUrl;
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
