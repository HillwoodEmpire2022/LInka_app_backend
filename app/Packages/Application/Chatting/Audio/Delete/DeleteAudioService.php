<?php

namespace App\Packages\Application\Chatting\Audio\Delete;

use App\Packages\Application\Chatting\Text\Delete\DeleteChatRequest;
use App\Packages\Infrastructure\VoiceMessageRepository;

class DeleteAudioService{

    protected $deleteChatRequest;
    protected $voiceMessageRepository;


    public function __construct(DeleteChatRequest $deleteChatRequest, VoiceMessageRepository $voiceMessageRepository)
    {
        $this->deleteChatRequest = $deleteChatRequest->getID();
        $this->voiceMessageRepository = $voiceMessageRepository;
    }

    public function deleteAudioChat(){

        return $this->voiceMessageRepository->deleteChat($this->deleteChatRequest);
    }
}