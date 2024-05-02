<?php

namespace App\Packages\Infrastructure;

use App\Models\Message;


class MessageRepository
{

    protected $messageData;
    protected $messageModel;

    public function __construct()
    {
        $this->messageModel=new Message();
    }

    public function createMessage(String $content, String $senderID, String $receiverID)
    {

        $message = Message::create([
            'sender_id' => $senderID, 
            'receiver_id' => $receiverID, 
            'content' => $content]);
            
            return $message->content;
        
    }

    public function chattlist(String $senderID, String $receiverID){
        $chatlist = $this->messageModel->where('sender_id', $senderID)
        ->where('receiver_id', $receiverID)
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
}
