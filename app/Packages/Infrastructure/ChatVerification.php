<?php

namespace App\Packages\Infrastructure;

use App\Packages\Application\Chatting\Send\ChattingRequest;
use Illuminate\Support\Facades\DB;
use App\Models\ChattingVerification;

class ChatVerification
{

    protected $chattingRequest;
    protected $senderID;
    protected $receiverID;
    protected $chattingVerificationModel;

    public function __construct(ChattingRequest $chattingRequest)
    {
        $this->senderID = $chattingRequest->senderID();
        $this->receiverID = $chattingRequest->receiverID();

        $this->chattingVerificationModel = new ChattingVerification();
    }

    public function senderValidation()
    {
        $senderStatus = $this->chattingVerificationModel->where('linkerUser_id', $this->senderID)->first();
        if(is_null( $senderStatus)){
            return "make sure you have paid";
        }
        else{
            return $senderStatus->linkerUser_id;
        }
        
    }

    public function receiverValidation()
    {
        $receiverStatus = $this->chattingVerificationModel->where('linkerUser_id', $this->receiverID)->first();
        if(is_null($receiverStatus))
        {
            return "Make sure you have paid";
        }
        else{
            return $receiverStatus->linkerUser_id;
        }
        
    }
}
