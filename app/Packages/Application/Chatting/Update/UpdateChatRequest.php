<?php

namespace App\Packages\Application\Chatting\Update;
use Illuminate\Http\Request;
use Exception;


class UpdateChatRequest{

    protected $message_id;
    protected $content;

    public function __construct(Request $request)
    {
        $this->message_id=$request->input('message_id');
        $this->content=$request->input('content');

        if (empty($this->message_id)) throw new Exception('No Message ID Provided');
        if (empty($this->message_id)) throw new Exception('No Message Content Provided');
    }

    public function getMessageID(){

        return $this->message_id;
    }

    public function getContent(){
        return $this->content;
    }
}