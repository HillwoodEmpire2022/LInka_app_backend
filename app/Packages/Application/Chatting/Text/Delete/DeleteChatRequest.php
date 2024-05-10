<?php

namespace App\Packages\Application\Chatting\Text\Delete;
use Illuminate\Http\Request;
use Exception;


class DeleteChatRequest{

    protected $message_id;

    public function __construct(Request $request)
    {
        $this->message_id=$request->input('message_id');
        
        if (empty($this->message_id)) throw new Exception('No Message ID Provided');
    }

    public function getID(){

        return $this->message_id;
    }
}