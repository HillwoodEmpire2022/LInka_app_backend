<?php

namespace App\Packages\Infrastructure;

use App\Models\VoiceMessage;


class VoiceMessageRepository
{

    protected $messageData;
    protected $messageModel;
    protected $conversationRepository;

    public function __construct()
    {
        $this->messageModel=new VoiceMessage();
        

    }

    public function AudioCreateMessage(String $voiceUrl, String $senderID, String $receiverID, String $conversationID)
    {

        $message = VoiceMessage::create([
            'sender_id' => $senderID, 
            'receiver_id' => $receiverID, 
            'voice_url' => $voiceUrl,
            'conversation_id' => $conversationID]);
            
            return $message->voice_url;
        
    }

    public function chattlist(String $senderID){
        $chatlist = $this->messageModel->where('sender_id', $senderID)
        
        ->select('content', 'sender_id', 'receiver_id', 'created_at')
        ->get();

        return $chatlist;
    }

    public function findOneAudio(String $id){

        return $this->messageModel->where('id', $id)->get();
    }

    public function deleteChat(String $id){
        
        $this->messageModel->destroy($id);
        return "deleted successfully";
    }

    public function updateChatt(String $id, array $content){

        $messageID = voiceMessage::findOrFail($id);
        return $messageID->update($content);
        
    }
}
