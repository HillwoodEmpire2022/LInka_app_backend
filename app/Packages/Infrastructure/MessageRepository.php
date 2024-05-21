<?php

namespace App\Packages\Infrastructure;

use App\Models\Message;



class MessageRepository
{

    protected $messageData;
    protected $messageModel;
    protected $conversationRepository;

    public function __construct()
    {
        $this->messageModel=new Message();
        

    }

    public function createMessage(String $content, String $senderID, String $receiverID, String $conversationID)
    {

        $message = Message::create([
            'sender_id' => $senderID, 
            'receiver_id' => $receiverID, 
            'content' => $content,
            'conversation_id' => $conversationID]);
            
            return $message->content;
        
    }

    public function chattlist(String $senderID){
        $chatlist = $this->messageModel->where('sender_id', $senderID)
        
        ->select('content', 'sender_id', 'receiver_id', 'created_at')
        ->get();

        return $chatlist;
    }

    public function deleteChat(String $id){
        
        $this->messageModel->destroy($id);
        return "deleted successfully";
    }

    public function updateChatt(String $id, array $content){

        $messageID = Message::findOrFail($id);
        return $messageID->update($content);  
    }

    public function findOneMessage(String $id){

        return $this->messageModel->where('id', $id)->get();
    }
}



