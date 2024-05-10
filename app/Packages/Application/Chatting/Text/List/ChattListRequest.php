<?php

namespace App\Packages\Application\Chatting\Text\List;
use Illuminate\Http\Request;
use Exception;


class ChattListRequest{

    protected $chatting;
    protected $senderID;
    protected $receiverID;

    public function __construct(Request $request)
    {
        
        $this->senderID = $request->input('senderID');
       

        
        if (empty($this->senderID)) throw new Exception('No Sender ID Provided');
        
    }

    public function senderID()
    {
        return $this->senderID;   
    }
}