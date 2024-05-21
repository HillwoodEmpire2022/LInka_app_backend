<?php

namespace App\Packages\Infrastructure;
use App\Models\Conversation;




class ConversationRepository{

    protected $conversationModel;


    public function __construct()
    {
        $this->conversationModel = new Conversation();
        
    }

    public function findOneConvo(String $id){
        $conversation = Conversation::find($id);

        $messages = $conversation->messages;
        $images = $conversation->imageMessages;
        $audio = $conversation->voiceMessages;
       
        
        return response([
            
            'Conversations'=>$messages,
            'Images sent'=>$images,
            'Audio sent'=>$audio
        ]);

    }

    public function findAllConvo(){

        return $this->conversationModel->get();
    }

    public function deleteConversation(String $id){
        
        return $this->conversationModel->destroy($id);

    }

    public function createConversation(String $senderID, String $receiverID)
    {

        $conversation = Conversation::where(function ($query) use ($senderID, $receiverID){
            $query->where('sender_id', $senderID)
                  ->where('receiver_id', $receiverID);
        })->orWhere(function ($query) use ($senderID, $receiverID){
            $query->where('sender_id', $receiverID)
                  ->where('receiver_id', $senderID);
        })->first();
                                        
        if($conversation){

            return $conversation->id;

        } 
        else{
           
           $newConversation = Conversation::create([
            'sender_id' => $senderID,
            'receiver_id' => $receiverID
           ]);

           return $newConversation->id;
        }

        
    }
}


