<?php

namespace App\Packages\Application\Chatting\Pictures\Send;
use Exception;
use Illuminate\Http\Request;


class PictureChattingRequest
{

    protected $imageUrl;
    protected $senderID;
    protected $receiverID;
    protected $conversationID;

    public function __construct(Request $request)
    {
        $this->imageUrl = $request->file('image');
        $this->senderID = $request->input('senderID');
        $this->receiverID = $request->input('receiverID');
        $this->conversationID = $request->input('Conversation_id');

        // dd($request->file('image'));

        if (is_null($this->imageUrl)) throw new Exception('Make sure that You updated the picture');
        if (empty($this->senderID)) throw new Exception('No Sender ID Provided');
        if (empty($this->receiverID)) throw new Exception('No Receiver ID Provided');
        if (empty($this->conversationID)) throw new Exception('No Conversation ID Provided');
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

    public function convoID()
    {
        return $this->conversationID;   
    }
}