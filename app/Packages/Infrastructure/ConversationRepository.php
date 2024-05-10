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
        $convoName = $conversation->Receiver;
        
        return response([
            'Conversation Name'=>$convoName,
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

    public function createConversation(String $id, String $receiver)
    {

        $conversation = Conversation::find($id);
        
        if(is_null($conversation)){

            $createConvo=Conversation::create([
                'id'=>$id,
                'Receiver'=>$receiver
            ]);

            return $createConvo->id;

        } 
        else{
           
            return $conversation->update(['Receiver'=>$receiver]);
        }

        
    }
}