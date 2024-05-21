<?php

namespace App\Packages\Application\Conversation\FindOneConversation;

use Illuminate\Http\Request;

class ConversationRequest{
    
    protected $convoID;
    
    public function __construct(Request $request)
    {
        $this->convoID = $request->input('Conversation_id');
    }

    public function getConvoID(){

        return $this->convoID;
    }
}