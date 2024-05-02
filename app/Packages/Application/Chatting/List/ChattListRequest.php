<?php

namespace App\Packages\Application\Chatting\List;
use Illuminate\Http\Request;
use Exception;


class ChattListRequest{

    protected $chatting;
    protected $senderID;
    protected $receiverID;

    public function __construct(Request $request)
    {
        
        $this->senderID = $request->input('senderID');
        $this->receiverID = $request->input('receiverID');

        
        if (empty($this->senderID)) throw new Exception('No Sender ID Provided');
        if (empty($this->receiverID)) throw new Exception('No Receiver ID Provided');
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