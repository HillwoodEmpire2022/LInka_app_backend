<?php

namespace App\Packages\Application\Chatting\Audio\Send;
use Exception;
use Illuminate\Http\Request;


class AudioChattingRequest
{

    protected $audioUrl;
    protected $senderID;
    protected $receiverID;
    protected $conversationID;

    public function __construct(Request $request)
    {
        $this->audioUrl = $request->file('audio');
        $this->senderID = $request->input('senderID');
        $this->receiverID = $request->input('receiverID');
        $this->conversationID = $request->input('Conversation_id');

        // dd($request->file('audio'));

        if (is_null($this->audioUrl)) throw new Exception('Make sure that You updated the Audio');
        if (empty($this->senderID)) throw new Exception('No Sender ID Provided');
        if (empty($this->receiverID)) throw new Exception('No Receiver ID Provided');
        if (empty($this->conversationID)) throw new Exception('No Conversation ID Provided');
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