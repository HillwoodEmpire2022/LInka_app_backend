<?php

namespace App\Packages\Application\Chatting\Text\Send;
use Exception;
use Illuminate\Http\Request;


class ChattingRequest
{

    protected $chatting;
    protected $content;
    protected $senderID;
    protected $receiverID;
    protected $conversationID;

    public function __construct(Request $request)
    {
        $this->content = $request->input('content');
        $this->senderID = $request->input('senderID');
        $this->receiverID = $request->input('receiverID');
        $this->conversationID = $request->input('Conversation_id');

        // if (empty($this->content)) throw new Exception('Make sure that You sent Something');
        if (empty($this->senderID)) throw new Exception('No Sender ID Provided');
        if (empty($this->receiverID)) throw new Exception('No Receiver ID Provided');
        if (empty($this->conversationID)) throw new Exception('No Conversation ID Provided');
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

    public function convoID()
    {
        return $this->conversationID;   
    }
}
