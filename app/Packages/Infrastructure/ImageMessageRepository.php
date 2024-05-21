<?php

namespace App\Packages\Infrastructure;

use App\Models\ImageMessage;


class ImageMessageRepository
{

    protected $messageData;
    protected $messageModel;
    protected $conversationRepository;

    public function __construct()
    {
        $this->messageModel=new ImageMessage();
        

    }

    public function pictureCreateMessage(String $imageUrl, String $senderID, String $receiverID, String $conversationID)
    {

        $message = ImageMessage::create([
            'sender_id' => $senderID, 
            'receiver_id' => $receiverID, 
            'image_url' => $imageUrl,
            'conversation_id' => $conversationID]);
            
            return $message->image_url;
        
    }

    public function chattlist(String $senderID){
        $chatlist = $this->messageModel->where('sender_id', $senderID)
        
        ->select('content', 'sender_id', 'receiver_id', 'created_at')
        ->get();

        return $chatlist;
    }

    public function findOnePicture(String $id){

        return $this->messageModel->where('id', $id)->get();
    }

    public function deleteChat(String $id){
        
        $this->messageModel->destroy($id);
        return "deleted successfully";
    }

    public function updateChatt(String $id, array $content){

        $messageID = ImageMessage::findOrFail($id);
        return $messageID->update($content);
        
    }
}
